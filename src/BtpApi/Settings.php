<?php

namespace BtpApi;

class Settings
{
    protected static $settings = [
        'host' => 'udp://127.0.0.1',
        'port' => 22400,
    ];

    public static function setSettings($options)
    {
        foreach ($options as $name=>$value) {
            static::set($name, $value);
        }
    }

    public static function getSettings()
    {
        return static::$settings;
    }

    public static function set($name, $value)
    {
        static::$settings[$name] = $value;
    }

    public static function get($name)
    {
        if (!isset(static::$settings[$name])) {
            return null;
        }
        return static::$settings[$name];
    }
}