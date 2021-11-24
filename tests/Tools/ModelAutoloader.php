<?php

namespace StubTests\Tools;

class ModelAutoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('StubTests\\', DIRECTORY_SEPARATOR, $class).'.php';
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
            $file = __DIR__ . '/..' . $file;
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}