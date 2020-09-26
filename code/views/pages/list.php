<?php

use App\DB\DB;
use App\Repositories\ArtifactsRepository;
use App\Shop;

$artifactsRepository = new ArtifactsRepository(DB::getInstance());
$shop = new Shop($artifactsRepository);

$ar = $artifactsRepository->create([
    'title' => 'SOme title',
    'flavour_text' => 'Artifact Description.... ',
    'price' => '666',
    'modifiers' => [
        "-10% to Fire Resistance",
        "+25% to Cold Resistance",
        "-20% to Lightning Resistance"
    ],
    'attributes' => [
        [
            "name" => "armour",
            "value" => 670,
        ],
        [
            "name" => "movement speed",
            "value" => "-5%",
        ],
    ]
]);

dd($ar);

?>

<div class="artifacts-container">
    <? foreach ($shop->getGoods() as $item) : ?>
        <? renderCard($item); ?>
    <? endforeach; ?>
</div>