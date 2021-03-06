<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb90da99149fa122f80a4d95746d290ec
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb90da99149fa122f80a4d95746d290ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb90da99149fa122f80a4d95746d290ec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb90da99149fa122f80a4d95746d290ec::$classMap;

        }, null, ClassLoader::class);
    }
}
