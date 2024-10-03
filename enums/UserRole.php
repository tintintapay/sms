<?php

class UserRole
{
    const ADMIN = 'admin';
    const COORDINATOR = 'coordinator';
    const ATHLETE = 'athlete';

    public static function getDescription($role)
    {
        return match ($role) {
            self::ADMIN => 'Administrator',
            self::COORDINATOR => 'Coordinator',
            self::ATHLETE => 'Athelete',
            default => "",
        };
    }
}
