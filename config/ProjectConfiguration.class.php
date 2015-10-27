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
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfTaskExtraPlugin');
    $this->enablePlugins('sfWhmcsPlugin');
    $this->enablePlugins('sfThumbnailPlugin');

    // loadHelpers does not exists when running from CLI
    if(php_sapi_name() !== 'cli')
    {
      $this->loadHelpers(array('I18N'));
    }
  }

  public function configureDoctrine()
  {
    // Hack for doctrine:build-schema to work with WHMCS tables. http://stackoverflow.com/a/7451729
    // TODO: Make sure these works as expected
    if(php_sapi_name() == "cli")
    {
      Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, false);
    }
  }
}
