<div class="product-item">
  <?php if(!empty($category)):?>
    <?= image_tag($category->getWebImagePath(true)); ?>
  <?php endif;?>
  <?php if($product->type == ShopProduct::TYPE_DOMAIN): ?>
    <span class="product-name"><?= __('Domain with %1% TLD', ['%1%' => $product->name]); ?></span>
  <?php else: ?>
    <div class="product-name"><?= $product->name ?></div>
    <div class="product-description"><?= $product->description ?></div>
  <?php endif; ?>
  <div class="billing-periods">
    <?php include_partial($productFormPartial, ['productForm' => $product->form]); ?>
  </div>
</div>