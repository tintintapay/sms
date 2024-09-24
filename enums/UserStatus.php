<?php

class UserStatus
{
    const PENDING = "pending";
    const ACTIVE = "active";
    const INACTIVE = "inactive";
    const DELETED = "deleted";

    public static function getDescription($status)
    {
        switch ($status) {
            case self::PENDING:
                return "Pending";
            case self::ACTIVE:
                return "Active";
            case self::INACTIVE:
                return "Inactive";
            case self::DELETED:
                return "Deleted";
        }
    }
}