<?php

require '../vendor/autoload.php';

use App\Application;

Application::init();

$pageName = 'list.php';
$pagePath = VIEWS_PATH . "/pages/$pageName";

require_once VIEWS_PATH . '/layout/main.php';
