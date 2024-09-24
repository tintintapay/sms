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
        switch ($sport) {
            case Sport::BASE_BALL:
                return 'Base Ball';

            case Sport::BASKET_BALL:
                return 'Basket Ball';

            case Sport::SOCCER:
                return 'Soccer';

            case Sport::SWIMMING:
                return 'Swimming';

            case Sport::TENNIS:
                return 'Tennis';

            default:
                return "";
        }
    }

    public static function fetchList()
    {
        return [
            Sport::BASE_BALL => self::getDescription(Sport::BASE_BALL),
            Sport::BASKET_BALL => self::getDescription(Sport::BASKET_BALL),
            Sport::SOCCER => self::getDescription(Sport::SOCCER),
            Sport::SWIMMING => self::getDescription(Sport::SWIMMING),
            Sport::TENNIS => self::getDescription(Sport::TENNIS),
        ];
    }
}
