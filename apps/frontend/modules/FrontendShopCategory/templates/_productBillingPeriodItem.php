<input type="radio" name="billing-period-<?= $product->id ?>" value="<?= $billingPeriodDetails['type'] ?>">

<span><?= $billingPeriodName ?></span>
<span class="main-price"><?= $billingPeriodDetails['base'] ?></span>
<?php if(isset($billingPeriodDetails['setup'])): ?>
  <span class="additional-price">(+<?= $billingPeriodDetails['setup'] ?>)</span>
<?php endif;?>
<span><?= $currentCurrency->suffix ?></span>
<br>