<div class="infobox-page-container">
    <div class="item-box unique">
        <div class="header double">
            <?= $item->title ?>
        </div>
        <div class="item-stats">
            <div class="group">
                <?= $item->renderAttributes(); ?>
            </div>

            <ul class="group tc mod">
                <? foreach ($item->modifiers as $modifier): ?>
                <li><?= $modifier ?></li>
                <? endforeach; ?>
            </ul>
            <div class="group tc flavour"><?= $item->description ?></div>
        </div>
        <div class="group">
            <span>Price:&nbsp;</span>
            <span class="price"><?= $item->price ?></span>
        </div>
        <div class="group artifact-image">
            <img src="<?= $item->imageUrl ?>" alt="<?= $item->title ?>" />
        </div>
    </div>
</div>