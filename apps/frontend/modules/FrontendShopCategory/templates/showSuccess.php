<div id="pitch">
  <span><?= $category->getName() ?></span>
  <span><?= image_tag($category->getWebImagePath()); ?></span>
  <div class="products-list">
    <?php foreach($products as $product):?>
      <div class="product-item">
        <?php if($product->type == 'domain'): ?>
          <input type="text" name="domain-name-<?= $product->id ?>"/>
          <span class="product-name"><?= $product->name ?></span>
        <?php else: ?>
          <div class="product-name"><?= $product->name ?></div>
          <div class="product-description"><?= $product->description ?></div>
        <?php endif; ?>
        <?php if($currentCurrency): ?>
          <div class="billing-periods">
            <?php foreach($product->getPrices($sf_user->getCurrencyId()) as $billingPeriodName => $billingPeriodDetails): ?>
              <input type="radio" name="billing-period-<?= $product->id ?>" value="<?= $billingPeriodDetails['type'] ?>">

              <span><?= $billingPeriodName ?></span>
              <span class="main-price"><?= $billingPeriodDetails['base'] ?></span>
              <?php if(isset($billingPeriodDetails['setup'])): ?>
                  <span class="additional-price">(+<?= $billingPeriodDetails['setup'] ?>)</span>
              <?php endif;?>
              <span><?= $currentCurrency->suffix ?></span>
              <br>
            <?php endforeach;?>
          </div>
        <?php endif; ?>
        <button class="add-to-cart" data-product-id="<?= $product->id ?>" data-product-type="<?= $product->type ?>"><?= __('Add to cart') ?></button>
      </div>
    <?php endforeach; ?>
  </div>
</div>
