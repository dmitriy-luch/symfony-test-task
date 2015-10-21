<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('bootstrapAdminThemePlugin');

    // loadHelpers does not exists when running from CLI
    if(php_sapi_name() !== 'cli')
    {
      $this->loadHelpers(array('I18N'));
    }

    $this->enablePlugins('sfDoctrineGuardPlugin');
  }
}
