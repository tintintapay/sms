<?php

class UserStatus
{
    const PENDING = "pending";
    const ACTIVE = "active";
    const INACTIVE = "inactive";
    const DELETED = "deleted";

    public static function getDescription($status)
    {
        return match ($status) {
            self::PENDING => "Pending",
            self::ACTIVE => "Active",
            self::INACTIVE => "Inactive",
            self::DELETED => "Deleted",
            default => "",
        };
    }
}