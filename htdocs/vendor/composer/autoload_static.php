<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd5355aec1b01d9eb9a1293f184ce4a10
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd5355aec1b01d9eb9a1293f184ce4a10::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd5355aec1b01d9eb9a1293f184ce4a10::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd5355aec1b01d9eb9a1293f184ce4a10::$classMap;

        }, null, ClassLoader::class);
    }
}
