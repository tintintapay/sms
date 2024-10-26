<?php

require_once 'core/Validation.php';

class AnnouncementRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('title', $request['title']);
        $this->isEmpty('description', $request['description']);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}