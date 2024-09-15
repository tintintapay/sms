<?php
class Helper
{
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    public static function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    public static function hashPassword($password)
    {
        // Can verify thru password_verify('<input>', '<saved data>')
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
