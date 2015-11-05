<div id="pitch">
    <p><?= __('Popular categories') ?></p>
    <?php if(count($categories)): ?>
        <ul>
            <?php foreach($categories as $category): ?>
                <li>
                    <a href="<?= url_for('category', $category); ?>">
                        <?= $category->getName() ?>
                        <span>
                            <?= __('Price starts from')?> <?= $category->getCheapestPrice($sf_user->getCurrencyId()) ?> <?= $sf_user->getCurrencyObject()->suffix?>
                        </span>
                        <?= image_tag($category->getWebImagePath(true)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</div>


