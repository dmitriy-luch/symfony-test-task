<?= $productForm->renderFormTag(url_for('update_in_cart'), ['method' => 'post', 'class' => 'add-to-cart-form']) ?>
  <?php echo $productForm ?><input type="submit" name="<?= $productForm->getName() ?>[action]" value="Update"><input type="submit" name="<?= $productForm->getName() ?>[action]" value="Remove" />
</form>