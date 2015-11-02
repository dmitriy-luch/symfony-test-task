<?= $productForm->renderFormTag(url_for('add_to_cart'), ['method' => 'post', 'class' => 'add-to-cart-form']) ?>
  <?php echo $productForm ?><input type="submit" value="Add to cart">
</form>