<div id="cart">
  <a href="<?= url_for('cart') ?>">
    <p><?=
      format_number_choice(
        '[0]No products in cart yet|[1]There is %1% product in cart|(1,+Inf]There are %1% products in cart',
        [
            '%1%' => $productsCount
        ],
        $productsCount
      );
    ?></p>
    <p><?= __('Total amount: %1% %2%', ['%1%' => $cartTotal, '%2%' => $sf_user->getCurrencyObject()->suffix]) ?></p>
  </a>
</div>