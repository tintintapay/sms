<?php

class Sport
{
    const BASE_BALL = 'base_ball';
    const BASKET_BALL = 'basket_ball';
    const SOCCER = 'soccer';
    const SWIMMING = 'swimming';
    const TENNIS = 'tennis';
    const VOLLEY_BALL = 'volley_ball';
    const BADMINTON = 'badminton';
    const TABLE_TENNIS = 'table_tennis';
    const ATHLETICS = 'athletics';
    const CHESS = 'chess';
    const TAEKWONDO = 'taekwondo';
    const SEPAK_TAKRAW = 'sepak_takraw';
    const ARNIS = 'arnis';
    const DANCE_SPORTS = 'dance_sports';
    const PENCAK_SILAT = 'pencak_silat';
    const KARATE = 'karate';

    public static function getDescription($sport)
    {
        return match ($sport) {
            self::BASE_BALL => 'Base Ball',
            self::BASKET_BALL => 'Basket Ball',
            self::SOCCER => 'Soccer',
            self::SWIMMING => 'Swimming',
            self::TENNIS => 'Tennis',
            self::VOLLEY_BALL => 'Volley Ball',
            self::BADMINTON => 'Badminton',
            self::TABLE_TENNIS => 'Table Tennis',
            self::ATHLETICS => 'Athletics',
            self::CHESS => 'Chess',
            self::TAEKWONDO => 'Taekwondo',
            self::SEPAK_TAKRAW => 'Sepak Takraw',
            self::ARNIS => 'Arnis',
            self::DANCE_SPORTS => 'Dance Sports',
            self::PENCAK_SILAT => 'Pencak Silat',
            self::KARATE => 'Karate',
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
            self::VOLLEY_BALL => self::getDescription(self::VOLLEY_BALL),
            self::BADMINTON => self::getDescription(self::BADMINTON),
            self::TABLE_TENNIS => self::getDescription(self::TABLE_TENNIS),
            self::ATHLETICS => self::getDescription(self::ATHLETICS),
            self::CHESS => self::getDescription(self::CHESS),
            self::TAEKWONDO => self::getDescription(self::TAEKWONDO),
            self::SEPAK_TAKRAW => self::getDescription(self::SEPAK_TAKRAW),
            self::ARNIS => self::getDescription(self::ARNIS),
            self::DANCE_SPORTS => self::getDescription(self::DANCE_SPORTS),
            self::PENCAK_SILAT => self::getDescription(self::PENCAK_SILAT),
            self::KARATE => self::getDescription(self::KARATE)
        ];
    }
}
