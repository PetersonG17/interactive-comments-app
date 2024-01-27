<?php

namespace App;

class ConfigLoader
{
    private const CONFIG_DIRECTORY = "../config";

    private static array $config = ['settings' => []];

    /**
     * Loads the array of configs from all the config files
     * @return array
     */
    public static function load(): array
    {
        $configFiles = array_diff(scandir(self::CONFIG_DIRECTORY), array('.', '..'));

        foreach ($configFiles as $file) {
            self::$config['settings'] = array_merge(self::$config['settings'], include(self::CONFIG_DIRECTORY . "/" . $file));
        }

        return self::$config;
    }
}
