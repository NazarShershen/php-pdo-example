<?php

namespace App;

class Application
{
    /**
     * Init method of our application
     *
     * @return void
     */
    public static function init(): void
    {
        define('PROJECT_ROOT', '/code');
        define('VIEWS_PATH', PROJECT_ROOT . '/views');
    }
}
