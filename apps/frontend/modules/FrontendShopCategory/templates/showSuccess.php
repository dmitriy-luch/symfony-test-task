<?php use_javascript('addToCart'); ?>
<div id="pitch">
  <span><?= $category->getName() ?></span>
  <span><?= image_tag($category->getWebImagePath()); ?></span>
  <div class="products-list">
    <?php foreach($products as $product):?>
      <?php include_partial('productItem', ['product' => $product, 'currentCurrency' => $sf_user->getCurrencyObject(), 'productFormPartial' => 'addToCartForm']); ?>
    <?php endforeach; ?>
  </div>
</div>
