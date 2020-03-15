<div class="artifacts-container">
    <? foreach ((new \App\Shop)->getGoods() as $item) : ?>
        <? renderCard($item); ?>
    <? endforeach; ?>
</div>