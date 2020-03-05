<?php

function getHeader() {
    return file_get_contents(VIEWS_PATH . "/layout/header.php", true);
}

function renderCard($item) {
    return include VIEWS_PATH . '/components/card.php';
}