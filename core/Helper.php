<?php
ini_set('post_max_size', '20M');
ini_set('upload_max_filesize', '20M');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/phpmailer/vendor/autoload.php';

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
        $maxSize = ($options['max_size'] ?? 2000) * 1024; // Default max size is 2000KB (2MB)
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
                return ['success' => false, 'message' => "Invalid file type. Only PDF, JPG, and PNG files are allowed."];
            }
        }

        return ['success' => false, 'message' => "No file uploaded."];
    }

    public static function sendMail($data)
    {
        // use
        // $template = file_get_contents('template/mail/allowance.html');
        // $body = str_replace('[Recipient_Name]', 'Elmers Glue', $template);
        // $data = [
        //     'email' => 'magnomagz@gmail.com',
        //     'name' => 'Elmer',
        //     'subject' => 'Test',
        //     'body' => $body,
        // ];
        // Helper::sendMail($data);

        $config = require 'config.php';
        //Create an instance; passing `true` enables exceptions
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

}
