<?php

class Sport
{
    const BASE_BALL = 'base_ball';
    const BASKET_BALL = 'basket_ball';
    const SOCCER = 'soccer';
    const SWIMMING = 'swimming';
    const TENNIS = 'tennis';

    public static function getDescription($sport)
    {
        return match ($sport) {
            self::BASE_BALL => 'Base Ball',
            self::BASKET_BALL => 'Basket Ball',
            self::SOCCER => 'Soccer',
            self::SWIMMING => 'Swimming',
            self::TENNIS => 'Tennis',
            default => "",
        };
    }

    public static function fetchList()
    {
        return [
            self::BASE_BALL => self::getDescription(self::BASE_BALL),
            self::BASKET_BALL => self::getDescription(self::BASKET_BALL),
            self::SOCCER => self::getDescription(self::SOCCER),
            self::SWIMMING => self::getDescription(self::SWIMMING),
            self::TENNIS => self::getDescription(self::TENNIS),
        ];
    }
}
