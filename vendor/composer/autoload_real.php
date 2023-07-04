<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb3e9a41cc26418dfc21c64ba4fbb491d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitb3e9a41cc26418dfc21c64ba4fbb491d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb3e9a41cc26418dfc21c64ba4fbb491d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb3e9a41cc26418dfc21c64ba4fbb491d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
