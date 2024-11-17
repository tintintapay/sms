<?php

abstract class Validation
{
    private $errors = [];

    public function isEmpty($field, $value)
    {
        if (empty(trim($value)) || $value === "") {
            $this->addError($field, ucfirst($field) . " cannot be empty.");
        }
    }

    public function passwordMatch($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            $this->addError('password', "Passwords do not match.");
        }
    }

    public function isExist($field, $key, $array)
    {
        if (!array_key_exists($key, $array)) {
            $this->addError($field, ucfirst($field) . " must not be empty.");
        }
    }

    public function minValue($field, $value, $minValue)
    {
        if ($value < $minValue) {
            $this->addError($field, ucfirst($field) . " must not be less than $minValue.");
        }
    }

    public function minLength($field, $value, $minLength)
    {
        if (strlen($value) < $minLength) {
            $this->addError($field, ucfirst($field) . " must be at least $minLength characters.");
        }
    }

    public function maxLength($field, $value, $maxLength)
    {
        if (strlen($value) > $maxLength) {
            $this->addError($field, ucfirst($field) . " must not exceed $maxLength characters.");
        }
    }

    public function maxValue($field, $value, $maxValue)
    {
        if ($value > $maxValue) {
            $this->addError($field, ucfirst($field) . " must not be greater than $maxValue.");
        }
    }

    public function isEmail($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "Invalid email address.");
        }
    }

    public function isValidPattern($field, $value, $pattern, $message)
    {
        if (!preg_match($pattern, $value)) {
            $this->addError($field, ucfirst($field) . " " . $message);
        }
    }

    public function hasAttachment($field, $value)
    {
        if (empty($value) || $value['size'] == 0) {
            $this->addError($field, ucfirst($field) . " cannot be empty.");
        }
    }

    public function isValidFileType($field, $value, $allowedTypes)
    {
        $allowedTypes = array_map('strtolower', $allowedTypes);
        $fileType = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));
        if (!in_array($fileType, $allowedTypes)) {
            $this->addError($field, ucfirst($field) . " must be of type " . implode(', ', $allowedTypes));
        }
    }

    public function isValidFileSize($field, $value, $maxSize = 5242880)
    {
        if ($value['size'] > $maxSize) {
            $this->addError($field, ucfirst($field) . " must not be greater than " . $this->formatFileSize($maxSize) . ".");
        }
    }

    private function formatFileSize($size)
    {
        if ($size >= 1073741824) {
            return round($size / 1073741824, 2) . " GB";
        } elseif ($size >= 1048576) {
            return round($size / 1048576, 2) . " MB";
        } elseif ($size >= 1024) {
            return round($size / 1024, 2) . " KB";
        } else {
            return $size . " bytes";
        }
    }

    public function isStrongPassword($field, $value)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
        if (!preg_match($pattern, $value)) {
            $this->addError(
                $field,
                "Password must be at least 8 characters, contain at least one uppercase letter, one lowercase letter and one number."
            );
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function passes()
    {
        return empty($this->errors);
    }

    public function addError($field, $message)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = ''; // Initialize as an empty string instead of an array
        }
        $this->errors[$field] .= ($this->errors[$field] ? '<br>' : '') . $message; // Append the message
    }
}

