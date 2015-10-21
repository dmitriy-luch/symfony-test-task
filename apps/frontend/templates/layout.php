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
      </div>
      <div class="clr"></div>
    </div>
    <div class="content">
      <?php include_component('page', 'menu') ?>
      <div class="messages">
        <?php if ($sf_user->hasFlash('error')): ?>
          <h2 class="flash_error"><?php echo $sf_user->getFlash('error') ?></h2>
        <?php endif ?>
        <?php if ($sf_user->hasFlash('warning')): ?>
          <h2 class="flash_warning"><?php echo $sf_user->getFlash('warning') ?></h2>
        <?php endif ?>
      </div>
      <?php echo $sf_content ?>
    </div>
    <div id="footer">
      <?php include_component('language', 'language', ['currentPage' => $sf_request->getUri()]) ?>
      <?php
      //Adding some text in footer to test i18n
      echo __('Some custom footer text');
      ?>
    </div>
  </div>
  </body>
</html>