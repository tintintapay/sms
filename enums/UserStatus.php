<?php

class UserStatus
{
    const PENDING = "pending";
    const ACTIVE = "active";
    const DELETED = "deleted";

    public static function getDescription($status)
    {
        switch ($status) {
            case self::PENDING:
                return "Pending";
            case self::ACTIVE:
                return "Active";
            case self::DELETED:
                return "Deleted";
        }
    }
}