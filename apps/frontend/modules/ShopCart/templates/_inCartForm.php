<?= $productForm->renderFormTag(url_for('delete_from_cart'), ['method' => 'post', 'class' => 'add-to-cart-form']) ?>
  <?php echo $productForm ?><input type="submit" name="<?= $productForm->getName() ?>[action]" value="Remove" />
</form>