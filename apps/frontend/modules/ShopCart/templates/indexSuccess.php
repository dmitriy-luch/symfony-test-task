<div id="pitch">
  <?php if($cart):?>
      User has cart
    <?php foreach($cart->getCartProducts() as $cartProduct): ?>
      <?= $cartProduct; ?>
    <?php endforeach;?>
  <?php else: ?>
      There is no cart yet
  <?php endif; ?>
</div>