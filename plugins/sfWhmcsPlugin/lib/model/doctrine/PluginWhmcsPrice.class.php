<?php

/**
 * PluginWhmcsPrice
 */
abstract class PluginWhmcsPrice extends BaseWhmcsPrice
{
  /**
   * List of product types related to domains
   *
   * @return array
   */
  public static function getDomainPriceTypes()
  {
    return [
        self::getNewDomainPriceType(),
        'domaintransfer',
        'domainrenew'
    ];
  }

  /**
   * New domain product type
   *
   * @return string
   */
  public static function getNewDomainPriceType()
  {
    return 'domainregister';
  }

  /**
   * List of product types related to products
   *
   * @return array
   */
  public static function getProductTypes()
  {
    return [
      self::getNewProductType()
    ];
  }

  /**
   * New product type
   *
   * @return string
   */
  public static function getNewProductType()
  {
    return 'product';
  }
}