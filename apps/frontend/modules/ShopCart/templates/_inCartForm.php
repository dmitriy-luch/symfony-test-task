<?= $productForm->renderFormTag(url_for(''), ['method' => 'post', 'class' => 'add-to-cart-form']) ?>
  <?php echo $productForm ?><input type="submit" value="Update" /><input type="submit" value="Remove" />
</form>