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

        $this->hasAttachment('Picture', $_FILES['picture']);
        $this->isValidFileType('Picture', $_FILES['picture'], ['jpg', 'png']);
        $this->isValidFileSize('Picture', $_FILES['picture']);

        $this->hasAttachment('COR', $_FILES['cor']);
        $this->isValidFileType('COR', $_FILES['cor'], ['pdf', 'jpg', 'png']);
        $this->isValidFileSize('COR', $_FILES['cor']);

        $this->hasAttachment('PSA', $_FILES['psa']);
        $this->isValidFileType('PSA', $_FILES['psa'], ['pdf', 'jpg', 'png']);
        $this->isValidFileSize('PSA', $_FILES['psa']);

        $this->hasAttachment('medical Cert', $_FILES['medical_cert']);
        $this->isValidFileType('medical Cert', $_FILES['medical_cert'], ['pdf', 'jpg', 'png']);
        $this->isValidFileSize('medical Cert', $_FILES['medical_cert']);

        $this->passwordMatch($request['password'], $request['confirm_password']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}