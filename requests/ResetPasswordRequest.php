<?php

require_once 'core/Validation.php';

class ResetPasswordRequest extends Validation
{
    public function validate($request)
    {
        $this->passwordMatch($request['password'], $request['confirm_password']);
        $this->isEmpty('password', $request['password']);
        $this->isEmpty('confirm_password', $request['confirm_password']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}