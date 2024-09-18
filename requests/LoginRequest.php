<?php

require_once 'core/Validation.php';

class LoginRequest
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