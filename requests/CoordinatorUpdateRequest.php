<?php

require_once 'core/Validation.php';

class CoordinatorUpdateRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('first name', $request['first_name']);
        $this->isEmpty('last name', $request['last_name']);
        $this->isEmpty('address', $request['address']);
        $this->isEmpty('gender', $request['gender']);
        $this->isEmail('email', $request['email']);
        if (!empty($request['password'])) {
            $this->isEmpty('password', $request['password']);
            $this->isEmpty('confirm password', $request['confirm_password']);
            $this->passwordMatch($request['password'], $request['confirm_password']);
        }
        
        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}