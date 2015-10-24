<?php

namespace Core\Classes;


class DBProvider extends Factory {
    public static function GetDriver($config, $db = 'MySQL')
    {
        switch (strtoupper($db)) {
            default: return self::GetClass('Core\Classes\MySQL', $config);
        }
    }
}