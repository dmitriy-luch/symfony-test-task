<?php

/**
 * Class ShopProduct contains one product instance (product or domain)
 */
class ShopProduct
{
  const WHMCS_PRODUCT_DISABLED_PRICE = -1;
  const WHMCS_DOMAIN_DISABLED_PRICE = 0;
  /**
   * @var string Product name
   */
  public $name;
  /**
   * @var string Product description
   */
  public $description;
  /**
   * @var string Product type (domain or product)
   */
  public $type;
  /**
   * @var int Product(Domain) WHMCS ID
   */
  public $id;

  /**
   * @var array List of prices indexed by currency
   */
  protected $prices;

  protected $currency;

  /**
   * List of Billing periods and WHMCS fields for each of them
   *
   * @return array
   */
  public function billingPeriods()
  {
    return [
      'Monthly' => [
        'base' => 'monthly',
        'setup' => 'msetupfee',
      ],
      'Quarterly' => [
        'base' => 'quarterly',
        'setup' => 'qsetupfee',
      ],
      'Semiannually' => [
        'base' => 'semiannually',
        'setup' => 'ssetupfee',
      ],
      'Annually' => [
        'base' => 'annually',
        'setup' => 'asetupfee',
      ],
      'Biennially' => [
        'base' => 'biennially',
        'setup' => 'bsetupfee',
      ],
      'Triennially' => [
        'base' => 'triennially',
        'setup' => 'tsetupfee',
      ],
    ];
  }

  /**
   * Builds product instance from WHMCS database array
   *
   * @param $product array Incoming product data (from WHMCS database)
   * - name Product name
   * - description Product description
   * - type Product type (product or domain)
   * - id Product(Domain) WHMCS Id
   * - Prices List of related prices
   */
  public function __construct($product)
  {
    // Get Name from incoming product or set empty string
    $this->name = (isset($product['name']))? $product['name'] : '';
    // Get Description from incoming product or set empty string
    $this->description = (isset($product['description']))? $product['description'] : '';
    // Get Type from incoming product or set null
    $this->type = (isset($product['type']))? $product['type'] : null;
    // Get Id from incoming product or set null
    $this->id = (isset($product['id']))? $product['id'] : null;

    // Get Prices from incoming product or set to empty array
    $prices = (isset($product['Prices']))? $product['Prices'] : [];
    // Initialize local prices array
    $this->prices = [];
    // Get parse prices function name based on product type
    $parseFunction = ($this->type == 'product')? 'parseProductPrices' : 'parseDomainPrices';
    foreach($prices as $currencyPrices)
    {
      // If no currency or type is provided in current array proceed to the next step
      if(!isset($currencyPrices['currency']) || !isset($currencyPrices['type']))
      {
        continue;
      }
      // Proceed with parsing prices for current currency
      $this->prices[$currencyPrices['currency']] = $this->$parseFunction($currencyPrices);
   }
  }

  /**
   * Parse currency prices based on Product prices structure
   *
   * @param $prices array List of prices for currency
   * @return array Parsed prices
   */
  protected function parseProductPrices($prices)
  {
    // Initialize result with an empty array
    $result = [];
    $currency = PluginWhmcsConnection::initConnection()->getCurrencies()->findById($prices['currency']);
    // Loop through billing periods
    foreach($this->billingPeriods() as $periodName => $periodDetails)
    {
      // Proceed to next price in case there is no base price provided or it is set to -1 (WHMCS Disable option)
      if(!isset($prices[$periodDetails['base']]) || $prices[$periodDetails['base']] == self::WHMCS_PRODUCT_DISABLED_PRICE)
      {
        continue;
      }
      // Initialize current billing period with base price and type
      $params = [
        'billingPeriod' => $periodName,
        'base' => $prices[$periodDetails['base']],
        'type' => $periodDetails['base'],
        'currencySuffix' => $currency->suffix,
      ];
      // In case setup option is provided and is not set to -1 (WHMCS Disable option)
      if(isset($prices[$periodDetails['setup']]) && $prices[$periodDetails['setup']] != self::WHMCS_PRODUCT_DISABLED_PRICE)
      {
        // Add setup value to the resulting array
        $params['setup'] = $prices[$periodDetails['setup']];
      }
      $result[$periodDetails['base']] = new ShopProductPrice($params);
    }
    return $result;
  }

  /**
   * Parse currency prices based on Domain prices structure
   *
   * @param $prices array List of prices for currency
   * @return array Parsed prices
   */
  protected function parseDomainPrices($prices)
  {
    // Initialize result with an empty array
    $result = [];
    $currency = PluginWhmcsConnection::initConnection()->getCurrencies()->findById($prices['currency']);
    if(!$currency){
      // TODO: Consider what to do next. Throw an exception probably
    }
    // Get all WHMCS Prices table fields that contain prices
    $priceFields = Doctrine::getTable('WhmcsPrice')->getPriceFields();
    // Loop through each price field
    foreach($priceFields as $index => $priceField)
    {
      // Proceed to next in case current price field is not provided or is 0 (WHMCS Disable option)
      if(!isset($prices[$priceField]) || $prices[$priceField] == 0)
      {
        continue;
      }
      // Get current billing period year
      $year = $index+1;
      // Initialize current billing period with base price and type
      $result[$priceField] = new ShopProductPrice(
        [
          'billingPeriod' => "$year year",
          'base' => $prices[$priceField],
          'type' => $priceField,
          'currencySuffix' => $currency->suffix,
        ]
      );
    }
    return $result;
  }

  /**
   * Prices for provided currency
   *
   * @param $currencyId int WHMCS Currency ID
   * @return array
   */
  public function getPrices($currencyId)
  {
    if(!isset($this->prices[$currencyId]))
    {
      return [];
    }
    return $this->prices[$currencyId];
  }

  /**
   * Return single price item for provided currency and billing period
   *
   * @param $currencyId
   * @param $billingPeriod
   * @return null|ShopProductPrice
   */
  public function getPrice($currencyId, $billingPeriod)
  {
    if(!isset($this->prices[$currencyId]) || !isset($this->prices[$currencyId][$billingPeriod]))
    {
      return null;
    }
    return $this->prices[$currencyId][$billingPeriod];
  }

  /**
   * Find one of Internal products (Product or Domain) based on type and whmcs id
   *
   * @param $type string 'domain' or 'product'
   * @param $id int WHMCS Product(Domain) ID
   * @return null|ShopProduct
   */
  public static function findOneByTypeAndId($type, $id)
  {
    switch($type)
    {
      case 'domain':
        return new self(Doctrine::getTable('WhmcsDomainTld')->findOneByIdWithPrices($id, Doctrine_Core::HYDRATE_ARRAY));
        break;
      case 'product':
        return new self(Doctrine::getTable('WhmcsProductInternal')->findOneByIdWithPrices($id, Doctrine_Core::HYDRATE_ARRAY));
        break;
    }
    // TODO: Consider what to do next. Throw an exception, log error
    return null;
  }
}