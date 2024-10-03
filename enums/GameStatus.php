<?php

class GameStatus
{
    const INACTIVE = 'inactive';
    const ACTIVE = 'active';
    const COMPLETED = 'completed';

    public static function getDescription($status)
    {
        return match ($status) {
            self::INACTIVE => 'Inactive',
            self::ACTIVE => 'Active',
            self::COMPLETED => 'Completed',
            default => "",
        };
    }
}