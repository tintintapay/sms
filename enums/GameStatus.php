<?php

class GameStatus
{
    const INACTIVE = 'inactive';
    const ACTIVE = 'active';
    const COMPLETED = 'completed';

    public static function getDescription($status)
    {
        switch ($status) {
            case GameStatus::INACTIVE:
                return 'Inactive';

            case GameStatus::ACTIVE:
                return 'Active';

            case GameStatus::COMPLETED:
                return 'Completed';

            default:
                return "";
        }
    }
}