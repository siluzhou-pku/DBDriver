<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit605457fd25e5db5a0c9aa52bc1f61607
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lulu\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lulu\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit605457fd25e5db5a0c9aa52bc1f61607::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit605457fd25e5db5a0c9aa52bc1f61607::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
