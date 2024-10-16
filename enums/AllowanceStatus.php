<?php

class AllowanceStatus
{
    const AVAILABLE = 'available';
    const RECEIVED = 'received';

    public static function getDescription($status)
    {
        return match ($status) {
            self::AVAILABLE => 'Available',
            self::RECEIVED => 'Received',
            default => "",
        };
    }
}