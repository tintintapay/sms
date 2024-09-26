<?php

abstract class Validation
{
    private $errors = [];

    public function isEmpty($field, $value)
    {
        if (empty(trim($value)) && $value === "") {
            $this->errors[$field] = ucfirst($field) . " cannot be empty.";
        }
    }

    public function passwordMatch($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            $this->errors['password'] = "Passwords do not match.";
        }
    }

    public function isExist($field, $key, $array)
    {
        if (!array_key_exists($key, $array)) {
            $this->errors[$field] = ucfirst($field) . " must not be empty";
        }
    }

    public function minLength($field, $value, $minLength)
    {
        if (strlen($value) < $minLength) {
            $this->errors[$field] = ucfirst($field) . " must be at least $minLength characters.";
        }
    }

    public function isEmail($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "Invalid email address.";
        }
    }

    public function isValidPattern($field, $value, $pattern, $message)
    {
        if (!preg_match($pattern, $value)) {
            $this->errors[$field] = $message;
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
        $this->errors[$field] = $message;
    }
}

