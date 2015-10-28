<div id="pitch">
    <p><?= __('Popular categories') ?></p>
    <?php if(count($categories)): ?>
        <ul>
            <?php foreach($categories as $category): ?>
                <li>
                    <a href="<?= url_for('category', $category); ?>">
                        <?= $category->getName() ?>
                        <?php if($currentCurrency && $category->getCheapestPrice($sf_user->getCurrencyId())): ?>
                        <span>
                            <?= __('Price starts from')?> <?= $category->getCheapestPrice($sf_user->getCurrencyId()) ?> <?= $currentCurrency->suffix?>
                        </span>
                        <?php endif;?>
                        <?= image_tag($category->getWebImagePath(true)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</div>


