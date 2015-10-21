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
    <header>
      <?php if ($sf_user->hasFlash('error')): ?>
        <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
      <?php endif ?>
      <?php if ($sf_user->hasFlash('warning')): ?>
        <div class="flash_warning"><?php echo $sf_user->getFlash('warning') ?></div>
      <?php endif ?>
    </header>
    <?php echo $sf_content ?>
    <footer>
      <div class="content">
        <?php include_component('language', 'language', ['currentPage' => $sf_request->getUri()]) ?>
      </div>
      <?php
        //Adding some text in footer to test i18n
        echo __('Some custom footer text');
      ?>
    </footer>
  </body>
</html>
