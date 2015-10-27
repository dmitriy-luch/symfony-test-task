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
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <?php if ($sf_user->isAuthenticated()): ?>
          <ul class="nav">
            <li><?php echo link_to('Pages', 'backend_page') ?></li>
            <li><?php echo link_to('Categories', 'shop_category') ?></li>
            <li><?php echo link_to('Logout', 'sf_guard_signout') ?></li>
          </ul>
        <?php endif ?>
      </div>
    </div>
  </div>

  <div class="container">
      <div class="content">
        <?php echo $sf_content ?>
      </div>
  </div>

  <footer class="footer">
    <div class="container">
      <?= __('Some custom footer text') ?>
    </div>
  </footer>
  </body>
</html>