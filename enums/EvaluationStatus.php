<?php

class EvaluationStatus
{
    const SUBMITTED = 'submitted';
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const DISAPPROVED = 'disapproved';

    public static function getDescription($status)
    {
        return match ($status) {
            EvaluationStatus::SUBMITTED => 'Submitted',
            EvaluationStatus::PENDING => 'Pending',
            EvaluationStatus::APPROVED => 'Approved',
            EvaluationStatus::DISAPPROVED => 'Disapproved',
            default => "",
        };
    }
}