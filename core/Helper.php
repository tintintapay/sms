<?php
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
}
