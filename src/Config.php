<?php namespace Znci\Lithium;

class Config
{
    private static $config;

    public static function get($type, $key, $default = null) {
        if (is_null(self::$config)) {
            self::$config = require_once(dirname(__DIR__, 1) . "/config/$type.php");
        }

        return !empty(self::$config[$key])?self::$config[$key]:$default;
    }
}
