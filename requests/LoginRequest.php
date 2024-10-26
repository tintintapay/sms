<?php

require_once 'core/Validation.php';

class LoginRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmail('email', $request['email']);
        $this->isEmpty('email', $request['email']);
        $this->isEmpty('password', $request['password']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}