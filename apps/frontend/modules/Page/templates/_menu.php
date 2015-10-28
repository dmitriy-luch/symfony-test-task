<?php if(count($pages) > 0): ?>
  <ul id="menu">
    <?php foreach($pages as $page): ?>
      <li>
        <a href="<?= url_for('page', $page); ?>"><?= $page->getTitle() ?></a>
      </li>
    <?php endforeach;?>
  </ul>
<?php endif; ?>