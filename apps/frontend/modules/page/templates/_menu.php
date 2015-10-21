<?php if(count($menuItems) > 0): ?>
  <ul id="menu">
    <?php foreach($menuItems as $menuItem): ?>
      <li>
        <a class="<?= ($menuItem['active'])? 'current' : '' ?>" href="<?= $menuItem['url'] ?>"><?= $menuItem['title'] ?></a>
      </li>
    <?php endforeach;?>
  </ul>
<?php endif; ?>