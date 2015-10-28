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
        <?php
          include_partial(
            'productBillingPeriodItem',
            [
              'product' => $product,
              'currentCurrency' => $currentCurrency,
              'billingPeriodName' => $billingPeriodName,
              'billingPeriodDetails' => $billingPeriodDetails
            ]
          );
        ?>
      <?php endforeach;?>
    </div>
  <?php endif; ?>
  <button class="add-to-cart" data-product-id="<?= $product->id ?>" data-product-type="<?= $product->type ?>"><?= __('Add to cart') ?></button>
</div>