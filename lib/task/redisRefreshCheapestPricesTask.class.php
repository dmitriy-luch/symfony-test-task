<?php

class redisRefreshCheapestPricesTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    $this->namespace        = 'redis';
    $this->name             = 'redisRefreshCheapestPrices';
    $this->briefDescription = 'Refresh cheapest prices';
    $this->detailedDescription = <<<EOF
The [redisRefreshCheapestPrices|INFO] task refreshes cheapest prices for all frontend categories.
Call it with:

  [php symfony redisRefreshCheapestPrices|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $frontendCategories = Doctrine::getTable('ShopCategory')->findAllFrontend();
    $currencies = PluginWhmcsConnection::initConnection()->getCurrencies();
    foreach ($frontendCategories as $frontendCategory)
    {
      foreach ($currencies as $currency)
      {
        $cheapestPrice = $frontendCategory->getCheapestPrice($currency->id, true);
        $this->log(sprintf('Category %s cheapest price for %s currency is %d.', $frontendCategory->getName(), $currency->code, $cheapestPrice));
      }
    }

  }
}
