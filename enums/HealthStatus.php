<?php

class HealthStatus
{
    const HEALTHY = 'healthy';
    const INJURED = 'injured';
    const RECOVERING = 'recovering';
    const REHABILITATING = 'rehabilitating';

    public static function getDescription($status)
    {
        return match ($status) {
            self::HEALTHY => 'Healthy',
            self::INJURED => 'Injured',
            self::RECOVERING => 'Recovering',
            self::REHABILITATING => 'Rehabilitating',
            default => "",
        };
    }

    public static function fetchList()
    {
        return [
            self::HEALTHY => self::getDescription(self::HEALTHY),
            self::INJURED => self::getDescription(self::INJURED),
            self::RECOVERING => self::getDescription(self::RECOVERING),
            self::REHABILITATING => self::getDescription(self::REHABILITATING)
        ];
    }

    public static function getPills($status)
    {
        return match ($status) {
            self::HEALTHY => '<div class="pills pills-success">' . self::getDescription(self::HEALTHY) . '</div>',
            self::INJURED => '<div class="pills pills-danger">' . self::getDescription(self::INJURED) . '</div>',
            self::RECOVERING => '<div class="pills pills-info">' . self::getDescription(self::RECOVERING) . '</div>',
            self::REHABILITATING => '<div class="pills pills-warning">' . self::getDescription(self::REHABILITATING) . '</div>',
            default => "",
        };
    }

    public static function getIcon($status)
    {
        return match ($status) {
            self::HEALTHY => '<div class="pills pill-icon pills-success"></div>',
            self::INJURED => '<div class="pills pill-icon pills-danger"></div>',
            self::RECOVERING => '<div class="pills pill-icon pills-info"></div>',
            self::REHABILITATING => '<div class="pills pill-icon pills-warning"></div>',
            default => "",
        };
    }
}