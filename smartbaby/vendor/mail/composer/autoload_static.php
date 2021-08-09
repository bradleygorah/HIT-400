<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5d456c2fab3fcc2642a5123fa801919a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5d456c2fab3fcc2642a5123fa801919a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5d456c2fab3fcc2642a5123fa801919a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
