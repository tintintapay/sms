<?php

require_once 'core/Validation.php';

class HealthRecordCreateRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('status', $request['status']);
        $this->isEmpty('remarks', $request['remarks']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}