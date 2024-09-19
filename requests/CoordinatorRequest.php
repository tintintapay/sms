<?php

require_once 'core/Validation.php';

class CoordinatorRequest
{
    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function validate($request)
    {
        $this->validation->isEmpty('first name', $request['first_name']);
        $this->validation->isEmpty('last name', $request['last_name']);
        $this->validation->isEmpty('password', $request['password']);
        $this->validation->isEmpty('address', $request['address']);
        $this->validation->isEmpty('gender', $request['gender']);
        $this->validation->isEmail('email', $request['email']);
        $this->validation->passwordMatch($request['password'], $request['confirm_password']);
        $this->validation->isEmpty('password', $request['password']);
        $this->validation->isEmpty('confirm password', $request['confirm_password']);
        

        return [
            'isValid' => $this->validation->passes(),
            'message' => implode('<br>', $this->validation->getErrors())
        ];
    }
}