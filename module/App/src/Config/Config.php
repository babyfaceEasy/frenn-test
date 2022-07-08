<?php

namespace App\Config;

class Config
{
    private static $initialised = false;
    private static $config = [];

    /**
     * @return void
     */
    public static function init(): void
    {
        static::$config =  array_merge(
            include __DIR__ . '/../../config/routes.php',
            include __DIR__ . '/../../config/controllers.php'
        );

        static::$initialised = true;
    }

    /**
     * @param string $key
     * 
     * @return mixed
     */
    public static function get(string $key)
    {
        if(false === static::$initialised) {
            static::init();
        }

        return array_key_exists($key, static::$config) ? static::$config[$key] : null;
    }
}