<?php

require '../vendor/autoload.php';

use App\Application;
use App\Shop;

Application::init();

$shop = new Shop();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Legendary Artifacts Shop</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?= getHeader() ?>

    <div class="artifacts-container">
        <? foreach ($shop->getGoods() as $item) : ?>
            <? renderCard($item); ?>
        <? endforeach; ?>
    </div>

</body>
</html>
