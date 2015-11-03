<div id="pitch">
  <?= $form->renderFormTag(url_for('billing'), ['method' => 'post', 'class' => 'billing-cart-form']) ?>
    <?php echo $form ?><input type="submit" value="Submit" />
  </form>
</div>