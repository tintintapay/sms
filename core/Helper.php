<?php
date_default_timezone_set('Asia/Manila');
ini_set('post_max_size', '20M');
ini_set('upload_max_filesize', '20M');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader of PHPmailer
require_once 'vendor/phpmailer/vendor/autoload.php';
require_once 'models/HealthRecord.php';

class Helper
{
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    public static function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    public static function hashPassword($password)
    {
        // Can verify thru password_verify('<input>', '<saved data>')
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // File Upload
    public static function fileUpload($options)
    {
        $target_dir = $options['target_dir'] ?? "uploads/";
        $file = $options['file'] ?? null;
        $allowedTypes = $options['allowed_types'] ?? ['pdf', 'jpg', 'png'];
        $maxSize = ($options['max_size'] ?? 5120) * 1024;
        $customName = $options['filename'] ?? null;

        // Create directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if ($file) {
            $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            $fileSize = $file["size"];

            // Check file size
            if ($fileSize > $maxSize) {
                return ['success' => false, 'message' => "File size exceeds the limit of " . ($maxSize / 1024) . " KB."];
            }

            // Check if the file type is allowed
            if (in_array($fileType, $allowedTypes)) {
                // Set custom filename or default to original name
                $filename = $customName ? $customName . "." . $fileType : basename($file["name"]);
                $target_file = $target_dir . $filename;

                // Move the uploaded file
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return [
                        'success' => true,
                        'message' => "File uploaded successfully!",
                        'file' => $filename
                    ];
                } else {
                    return ['success' => false, 'message' => "Error uploading file."];
                }
            } else {
                return ['success' => false, 'message' => "Invalid file type. Only " . strtoupper(implode(", ", $allowedTypes)) . " files are allowed."];
            }
        }

        return ['success' => false, 'message' => "No file uploaded."];
    }

    public static function sendMail($data)
    {
        $config = require 'config.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $config['mailer']['username'];
            $mail->Password = $config['mailer']['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients
            $mail->setFrom($config['mailer']['username'], 'Sportan Portal');
            if (is_array($data['email'])) {
                foreach ($data['email'] as $email) {
                    $mail->addAddress($email['email'], $email['name']);
                }
            } else {
                $mail->addAddress($data['email'], $data['name']);
            }

            //Content
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body = $data['body'];

            if ($mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public static function getAge($birthdate)
    {
        $birthDate = new DateTime($birthdate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;

        return $age;
    }

    public static function formatDate($date, $format)
    {
        if (empty($date)) {
            return null;
        }

        $dateTime = new DateTime($date);

        return $dateTime->format($format);
    }

    public static function encryptEmail($email)
    {
        // Encryption key and method
        $config = require 'config.php';

        $key = $config['encryption_key']; // Must be kept secure and private
        $method = 'AES-256-CBC';

        // Encrypt email
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
        $encryptedEmail = openssl_encrypt($email, $method, $key, 0, $iv);
        $encryptedEmail = base64_encode("$encryptedEmail::$iv");

        return $encryptedEmail;
    }

    public static function decryptEmail($email)
    {
        $config = require 'config.php';
        $key = $config['encryption_key'];
        $method = 'AES-256-CBC';

        // Decrypt email
        [$encryptedData, $iv] = explode('::', base64_decode($email), 2);

        // Ensure IV is 16 bytes long
        $iv = str_pad($iv, 16, "\0");

        $decryptedEmail = openssl_decrypt($encryptedData, $method, $key, 0, $iv);
        return $decryptedEmail;
    }

    public static function isExpired($dateString, $minutes)
    {
        $date = new DateTime($dateString);
        $currentDate = new DateTime();
        $interval = $currentDate->diff($date);

        $minutesElapsed = $interval->days * 24 * 60;
        $minutesElapsed += $interval->h * 60;
        $minutesElapsed += $interval->i;

        if ($minutesElapsed <= $minutes) {
            return false;
        }

        return true;
    }

    public static function getHealthStatus($athlete_id)
    {
        $record = new HealthRecord();

        $healthStatus = $record->getLatest($athlete_id);

        return $healthStatus['status'] ?? '';
    }

    public static function athleteWithHealthStatus($user_id, $full_name)
    {
        $template = file_get_contents('template/widgets/athlete-with-healthstatus.html');
        $component = str_replace('[Icon]', HealthStatus::getIcon(self::getHealthStatus($user_id)), $template);
        $component = str_replace('[User_Id]', $user_id, $component);
        $component = str_replace('[Name]', $full_name, $component);

        return $component;
    }
}
