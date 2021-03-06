<?php

/**
 * ShopCart
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShopCart extends BaseShopCart
{
  /**
   * @var array Cart total amounts indexed by currency id
   */
  protected $cartTotal = [];

  /**
   * Cart total amount for requested currency id
   *
   * @param $currencyId
   * @return double
   */
  public function getCartTotal($currencyId)
  {
    if (!isset($this->cartTotal[$currencyId]))
    {
      $this->calculateCartTotal($currencyId);
    }
    return $this->cartTotal[$currencyId];
  }

  /**
   * Truncate cart totals array so that it will be re-calculated once needed
   */
  public function truncateCartTotal()
  {
    $this->cartTotal = [];
  }

  /**
   * Calculate Cart total ammount for a currency and save it locally
   *
   * @param $currencyId
   */
  protected function calculateCartTotal($currencyId)
  {
    // Initialize Cart total amount for current currency
    $this->cartTotal[$currencyId] = 0;
    // Loop through each of products added to cart
    foreach ($this->getCartProducts() as $cartProduct)
    {
      // Get total price for cart product based on currency id and add it to current total
      $this->cartTotal[$currencyId] += $cartProduct->getTotalPrice($currencyId);
    }
  }

  /**
   * Get Client from WHMCS if client_id is set
   *
   * @return null|SimpleXmlElement WHMCS Client object
   */
  public function getClient()
  {
    $clientId = $this->getClientId();
    if(!empty($clientId))
    {
      return PluginWhmcsConnection::initConnection()->getClientById($clientId);
    }
    return null;
  }
}
