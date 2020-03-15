<?php

require '../vendor/autoload.php';

use App\Application;

Application::init();

$pageName = 'list.php';

if (isset($_GET['page'])) {

    $requestedPage = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

    if ($requestedPage == 'add-artifact') {
        $pageName = 'add-item.php';
    } elseif ('another-page') {
        //
    }
}

$pagePath = VIEWS_PATH . "/pages/$pageName";

require_once VIEWS_PATH . '/layout/main.php';
