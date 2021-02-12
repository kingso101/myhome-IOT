<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdf6e2051d63a27e05bf2cc8750672685
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdf6e2051d63a27e05bf2cc8750672685::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdf6e2051d63a27e05bf2cc8750672685::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdf6e2051d63a27e05bf2cc8750672685::$classMap;

        }, null, ClassLoader::class);
    }
}
