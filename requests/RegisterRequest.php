<?php

require_once 'core/Validation.php';

class RegisterRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('email', $request['email']);
        $this->isEmail('email', $request['email']);
        $this->isEmpty('password', $request['password']);
        $this->isEmpty('confirm_password', $request['confirm_password']);
        $this->isEmpty('first_name', $request['first_name']);
        $this->isEmpty('last_name', $request['last_name']);
        $this->isEmpty('gender', $request['gender']);
        $this->isEmpty('year_level', $request['year_level']);
        $this->isEmpty('course', $request['course']);
        $this->isEmpty('address', $request['address']);
        $this->isEmpty('school', $request['school']);
        $this->isEmpty('guardian', $request['guardian']);
        $this->isEmpty('age', $request['age']);
        $this->isEmpty('sport', $request['sport']);
        $this->isEmpty('phone_number', $request['phone_number']);

        $this->passwordMatch($request['password'], $request['confirm_password']);

        if (!$this->passes()) {
            // Handle validation errors
            $err = $this->getErrors();
            foreach ($err as $key => $value) {
                echo "$key : $value";
            }

            die();
        }
    }
}