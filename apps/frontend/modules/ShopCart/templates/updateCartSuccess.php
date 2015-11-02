<div id="pitch">
  <?= $form->renderFormTag(url_for('update_cart'), ['method' => 'post', 'class' => 'update-cart-form']) ?>
    <?php echo $form ?><input type="submit" value="Update" />
  </form>
</div>