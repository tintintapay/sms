<?php

require_once 'core/Validation.php';

class RegisterRequest
{
    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function validate($request)
    {
        $this->validation->isEmpty('email', $request['email']);
        $this->validation->isEmail('email', $request['email']);
        $this->validation->isEmpty('password', $request['password']);
        $this->validation->isEmpty('confirm_password', $request['confirm_password']);
        $this->validation->isEmpty('first_name', $request['first_name']);
        $this->validation->isEmpty('last_name', $request['last_name']);
        $this->validation->isEmpty('gender', $request['gender']);
        $this->validation->isEmpty('year_level', $request['year_level']);
        $this->validation->isEmpty('course', $request['course']);
        $this->validation->isEmpty('address', $request['address']);
        $this->validation->isEmpty('school', $request['school']);
        $this->validation->isEmpty('guardian', $request['guardian']);
        $this->validation->isEmpty('age', $request['age']);
        $this->validation->isEmpty('sport', $request['sport']);
        $this->validation->isEmpty('phone_number', $request['phone_number']);

        $this->validation->passwordMatch($request['password'], $request['confirm_password']);

        if (!$this->validation->passes()) {
            // Handle validation errors
            $err = $this->validation->getErrors();
            foreach ($err as $key => $value) {
                echo "$key : $value";
            }

            die();
        }
    }
}