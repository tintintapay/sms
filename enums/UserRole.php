<?php

class UserRole
{
    const ADMIN = 'admin';
    const COORDINATOR = 'coordinator';
    const ATHLETE = 'athlete';

    public static function getDescription($role)
    {
        switch ($role) {
            case UserRole::ADMIN:
                return 'Administrator';

            case UserRole::COORDINATOR:
                return 'Coordinator';

            case UserRole::ATHLETE:
                return 'Athelete';

            default:
                return "----";
        }
    }
}
