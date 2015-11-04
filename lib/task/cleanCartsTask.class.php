<?php

class cleanCartsTask extends sfBaseTask
{
  protected function configure()
  {
     $this->addArguments(array(
       new sfCommandArgument('days_old', sfCommandArgument::REQUIRED, 'Number of days for old carts'),
     ));

    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    $this->namespace        = 'project';
    $this->name             = 'cleanCarts';
    $this->briefDescription = 'Clean old carts';
    $this->detailedDescription = <<<EOF
The [cleanCarts|INFO] task removes old carts from DB.
Call it with:

  [php symfony cleanCarts|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // Remove carts that older than provided number of days
    $numberOfDeletedCarts = Doctrine::getTable('ShopCart')->removeOldCarts($arguments['days_old']);
    $this->log(sprintf('%d carts were removed.', $numberOfDeletedCarts));
  }
}
