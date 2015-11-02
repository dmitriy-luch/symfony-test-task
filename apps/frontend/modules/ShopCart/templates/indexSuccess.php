<div id="pitch">
  <?php if($cart):?>
    <div class="cart">
        <div class="products-list">
          <?php foreach($products as $product):?>
            <?php include_partial('FrontendShopCategory/productItem', ['product' => $product, 'productFormPartial' => 'inCartForm', 'category' => $product->form->getObject()->getShopCategory()]); ?>
          <?php endforeach; ?>
        </div>
      <?= link_to('Checkout', 'update_cart'); ?>
    </div>
  <?php else: ?>
      There is no cart yet
  <?php endif; ?>
</div>