<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9891e231b9ee86046633b4138857d29
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Spr\\ServiceSdk\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Spr\\ServiceSdk\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9891e231b9ee86046633b4138857d29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9891e231b9ee86046633b4138857d29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc9891e231b9ee86046633b4138857d29::$classMap;

        }, null, ClassLoader::class);
    }
}
