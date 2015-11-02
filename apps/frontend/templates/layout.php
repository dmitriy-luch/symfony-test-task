<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
  <div id="wrapper">
    <div id="header">
      <div id="logo">
        <h1><?= link_to(sfConfig::get('app_name', __('My project')), 'homepage')?></h1>
        <?php include_component('ShopCart', 'cart'); ?>
      </div>
      <div class="clr"></div>
    </div>
    <div class="content">
      <?php include_component('Page', 'menu') ?>
      <div class="messages">
        <?php if ($sf_user->hasFlash('error')): ?>
          <h2 class="flash_error"><?php echo $sf_user->getFlash('error') ?></h2>
        <?php endif ?>
        <?php if ($sf_user->hasFlash('warning')): ?>
          <h2 class="flash_warning"><?php echo $sf_user->getFlash('warning') ?></h2>
        <?php endif ?>
        <?php if ($sf_user->hasFlash('success')): ?>
          <h2 class="flash_success"><?php echo $sf_user->getFlash('success') ?></h2>
        <?php endif ?>
      </div>
      <div class="view-content">
        <?php echo $sf_content ?>
      </div>
    </div>
    <div id="footer">
      <?php
        include_component(
          'Language',
          'language',
          [
            'currentPage' => $sf_request->getUri(),
            'objectId' => $sf_request->getAttribute('objectId'),
            'objectClass' => $sf_request->getAttribute('objectClass'),
            'objectRoute' => $sf_request->getAttribute('objectRoute'),
          ]
        )
      ?>
      <?php
      //Adding some text in footer to test i18n
      echo __('Some custom footer text');
      ?>
    </div>
  </div>
  </body>
</html>