<div class="product-item">
  <?php if($product->type == 'domain'): ?>
    <span class="product-name"><?= __('Domain with %1% TLD', ['%1%' => $product->name]); ?></span>
  <?php else: ?>
    <div class="product-name"><?= $product->name ?></div>
    <div class="product-description"><?= $product->description ?></div>
  <?php endif; ?>
  <div class="billing-periods">
    <?php include_partial($productFormPartial, ['productForm' => $product->form]); ?>
  </div>
</div>