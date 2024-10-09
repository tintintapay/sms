<?php

require_once 'core/Validation.php';

class AthletesRatingRequest extends Validation
{
    public function validate($request)
    {

        // Is empty
        $this->isEmpty('teamwork', $request['teamwork']);
        $this->isEmpty('sportsmanship', $request['sportsmanship']);
        $this->isEmpty('technical skills', $request['technical_skills']);
        $this->isEmpty('adaptability', $request['adaptability']);

        $this->maxValue('teamwork', $request['teamwork'], 10);
        $this->maxValue('sportsmanship', $request['sportsmanship'], 10);
        $this->maxValue('technical skills', $request['technical_skills'], 10);
        $this->maxValue('adaptability', $request['adaptability'], 10);

        $this->minValue('teamwork', $request['teamwork'], 1);
        $this->minValue('sportsmanship', $request['sportsmanship'], 1);
        $this->minValue('technical skills', $request['technical_skills'], 1);
        $this->minValue('adaptability', $request['adaptability'], 1);

        // Number only
        $numberOnly = '/^[0-9]+$/';
        $message = 'Only numbers allowed';

        $this->isValidPattern('teamwork', $request['teamwork'], $numberOnly, $message);
        $this->isValidPattern('sportsmanship', $request['sportsmanship'], $numberOnly, $message);
        $this->isValidPattern('technical skills', $request['technical_skills'], $numberOnly, $message);
        $this->isValidPattern('adaptability', $request['adaptability'], $numberOnly, $message);

        return [
            'isValid' => $this->passes(),
            'message' => implode('<br>', $this->getErrors())
        ];
    }
}