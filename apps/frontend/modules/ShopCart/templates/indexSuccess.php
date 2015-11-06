<div id="pitch">
  <?php if($cart):?>
    <div class="cart">
        <div class="products-list">
          <?php foreach($products as $product):?>
            <?php include_partial('FrontendShopCategory/productItem', ['product' => $product, 'productFormPartial' => 'inCartForm', 'category' => $product->form->getObject()->getShopCategory()]); ?>
          <?php endforeach; ?>
        </div>
      <?php if(!$cart->getClient()): ?>
        <div class="checkout-link">
          <?= link_to('Checkout as existing customer', 'update_cart', ['existing' => true]); ?>
        </div>
        <div class="checkout-link">
          <?= link_to('Checkout as new customer', 'update_cart'); ?>
        </div>
      <?php else: ?>
        <div class="checkout-link">
          <?= link_to('Checkout', 'update_cart'); ?>
        </div>
      <?php endif;?>
    </div>
  <?php else: ?>
      There is no cart yet
  <?php endif; ?>
</div>