<?php

namespace app\core;

class Config
{
    const path = 'app/configs/';
    static array $configs;

    public function __construct()
    {
        foreach (glob(self::path . '*.php') as $filename)
            self::$configs[basename($filename)] = require($filename);
    }

    static function getConfig(string $filename): array
    {
        if (file_exists(self::path . $filename))
            return self::$configs[$filename];
        else die(__METHOD__);
    }
}
