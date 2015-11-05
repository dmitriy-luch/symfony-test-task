<?php

class redisClearShopProductsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    $this->namespace        = 'redis';
    $this->name             = 'redisClearShopProducts';
    $this->briefDescription = 'Clear Shop Products';
    $this->detailedDescription = <<<EOF
The [redisClearShopProducts|INFO] task clears all Shop Products from Redis cache.
Call it with:

  [php symfony redisClearShopProducts|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $redis = sfRedis::getClient();
    $redis->del('shopProduct');
    $this->log('Shop Products were removed from cache.');
  }
}
