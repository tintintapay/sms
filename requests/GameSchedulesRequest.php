<?php

require_once 'core/Validation.php';

class GameSchedulesRequest extends Validation
{
    public function validate($request)
    {
        $this->isEmpty('game title', $request['game_title']);
        $this->isEmpty('schedule', $request['schedule']);
        $this->isExist('sport', 'sport', $request);
        $this->isExist('target athlete', 'athletes', $request);
        
        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}