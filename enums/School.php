<?php

class School
{
    const BATSTATEU_PABLO_BORBON_CAMPUS = "batstateu_pablo_borbon_campus";
    const BATSTATEU_ALANGILAN_CAMPUS = "batstateu_alangilan_campus";
    const BATSTATEU_ARASOF_NASUGBU_CAMPUS = "batstateu_arasof_nasugbu_campus";
    const BATSTATEU_LIPA_CAMPUS = "batstateu_lipa_campus";
    const BATSTATEU_JPLPC_MALVAR_CAMPUS = "batstateu_jplpc_malvar_campus";
    const BATSTATEU_BALAYAN_CAMPUS = "batstateu_balayan_campus";
    const BATSTATEU_LEMERY_CAMPUS = "batstateu_lemery_campus";
    const BATSTATEU_ROSARIO_CAMPUS = "batstateu_rosario_campus";
    const BATSTATEU_SAN_JUAN_CAMPUS = "batstateu_san_juan_campus";
    const BATSTATEU_MABINI_CAMPUS = "batstateu_mabini_campus";
    const BATSTATEU_LOBO_CAMPUS = "batstateu_lobo_campus";

    public static function getDescription($sport)
    {
        return match ($sport) {
            self::BATSTATEU_PABLO_BORBON_CAMPUS => 'BatStateU Pablo Borbon Campus',
            self::BATSTATEU_ALANGILAN_CAMPUS => 'BatStateU Alangilan Campus',
            self::BATSTATEU_ARASOF_NASUGBU_CAMPUS => 'BatStateU ARASOF Nasugbu Campus',
            self::BATSTATEU_LIPA_CAMPUS => 'BatStateU Lipa Campus',
            self::BATSTATEU_JPLPC_MALVAR_CAMPUS => 'BatStateU JPLPC Malvar Campus',
            self::BATSTATEU_BALAYAN_CAMPUS => 'BatStateU Balayan Campus',
            self::BATSTATEU_LEMERY_CAMPUS => 'BatStateU Lemery Campus',
            self::BATSTATEU_ROSARIO_CAMPUS => 'BatStateU Rosario Campus',
            self::BATSTATEU_SAN_JUAN_CAMPUS => 'BatStateU San Juan Campus',
            self::BATSTATEU_MABINI_CAMPUS => 'BatStateU Mabini Campus',
            self::BATSTATEU_LOBO_CAMPUS => 'BatStateU Lobo Campus',
            default => "",
        };
    }

    public static function fetchList()
    {
        return [
            self::BATSTATEU_PABLO_BORBON_CAMPUS => self::getDescription(self::BATSTATEU_PABLO_BORBON_CAMPUS),
            self::BATSTATEU_ALANGILAN_CAMPUS => self::getDescription(self::BATSTATEU_ALANGILAN_CAMPUS),
            self::BATSTATEU_ARASOF_NASUGBU_CAMPUS => self::getDescription(self::BATSTATEU_ARASOF_NASUGBU_CAMPUS),
            self::BATSTATEU_LIPA_CAMPUS => self::getDescription(self::BATSTATEU_LIPA_CAMPUS),
            self::BATSTATEU_JPLPC_MALVAR_CAMPUS => self::getDescription(self::BATSTATEU_JPLPC_MALVAR_CAMPUS),
            self::BATSTATEU_BALAYAN_CAMPUS => self::getDescription(self::BATSTATEU_BALAYAN_CAMPUS),
            self::BATSTATEU_LEMERY_CAMPUS => self::getDescription(self::BATSTATEU_LEMERY_CAMPUS),
            self::BATSTATEU_ROSARIO_CAMPUS => self::getDescription(self::BATSTATEU_ROSARIO_CAMPUS),
            self::BATSTATEU_SAN_JUAN_CAMPUS => self::getDescription(self::BATSTATEU_SAN_JUAN_CAMPUS),
            self::BATSTATEU_MABINI_CAMPUS => self::getDescription(self::BATSTATEU_MABINI_CAMPUS),
            self::BATSTATEU_LOBO_CAMPUS => self::getDescription(self::BATSTATEU_LOBO_CAMPUS)
        ];
    }
}
