<?php

class redisRefreshCurrenciesTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
    ));

    $this->namespace        = 'redis';
    $this->name             = 'redisRefreshCurrencies';
    $this->briefDescription = 'Refresh Currencies';
    $this->detailedDescription = <<<EOF
The [redisRefreshCurrencies|INFO] task refreshes currencies in Redis cache.
Call it with:

  [php symfony redisRefreshCurrencies|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $currencies = PluginWhmcsConnection::initConnection()->getCurrencies(true)->all();
    $this->log(sprintf('%s currencies were loaded.', join(', ', array_keys($currencies))));
  }
}
