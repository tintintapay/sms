<?php

require_once 'core/Validation.php';

class RegisterRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('email', $request['email']);
        $this->isEmail('email', $request['email']);
        $this->isEmpty('password', $request['password']);
        $this->isEmpty('confirm Password', $request['confirm_password']);
        $this->isEmpty('first Name', $request['first_name']);
        $this->isEmpty('last Name', $request['last_name']);
        $this->isEmpty('gender', $request['gender']);
        $this->isEmpty('year Level', $request['year_level']);
        $this->isEmpty('course', $request['course']);
        $this->isEmpty('address', $request['address']);
        $this->isEmpty('school', $request['school']);
        $this->isEmpty('guardian', $request['guardian']);
        $this->isEmpty('sport', $request['sport']);
        $this->isEmpty('phone Number', $request['phone_number']);
        $this->isEmpty('terms', $request['terms']);
        $this->hasAttachement('Picture', $_FILES['picture']);
        $this->hasAttachement('COR', $_FILES['cor']);
        $this->hasAttachement('PSA', $_FILES['psa']);
        $this->hasAttachement('medical Cert', $_FILES['medical_cert']);

        $this->passwordMatch($request['password'], $request['confirm_password']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}