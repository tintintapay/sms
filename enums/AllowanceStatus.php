<?php

class AllowanceStatus
{
    const NOT_YET_CLAIMED = 'not_yet_claimed';
    const CLAIMED = 'claimed';

    public static function getDescription($status)
    {
        return match ($status) {
            self::NOT_YET_CLAIMED => 'Not Yet Claimed',
            self::CLAIMED => 'Claimed',
            default => "",
        };
    }
}