<?php

/**
 * ShopCartBilling form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 */
class ShopCartBillingForm extends sfForm
{
  public function __construct($object = null, $options = array(), $CSRFSecret = null)
  {
    if(empty($options['user']))
    {
      throw new Exception('user is required');
    }

    parent::__construct($object, $options, $CSRFSecret);
  }

  public function configure()
  {
    $paymentMethods = PluginWhmcsConnection::initConnection()->getPaymentMethods();
    $this->setWidget('payment_method', new sfWidgetFormChoice(['choices' => $paymentMethods]));
    $this->setValidator('payment_method', new sfValidatorChoice(['choices' => array_keys($paymentMethods)]));

    $this->widgetSchema->setNameFormat('billing_cart[%s]');
  }

  /**
   * Create order based on cart products
   *
   * @return bool|SimpleXmlElement Newly created order or false in case of error
   */
  public function createOrder()
  {

    $cart = $this->options['user']->getCart();
    // Fill in client ID from current cart
    $params['clientid'] = $cart->getClientId();
    // Get payment method from submitted form
    $params['paymentmethod'] = $this->getValue('payment_method');
    $productIndex = 0;
    foreach ($cart->getCartProducts() as $cartProduct)
    {
      // Get params for each of cart products
      $productParams = $this->generateProductsParams($cartProduct);
      foreach ($productParams as $productParamKey => $productParamValue)
      {
        // Save params with appended product index
        $params[$productParamKey . "[$productIndex]"] = $productParamValue;
      }
      $productIndex++;
    }
    // Execute order creation method from WHMCS Connection object
    return PluginWhmcsConnection::initConnection()->createOrder($params);
  }

  /**
   * Generate product params based on provided cart product
   *
   * @param $cartProduct
   * @return array Product params
   */
  protected function generateProductsParams($cartProduct)
  {
    $result = [];
    switch($cartProduct->type)
    {
      case ShopProduct::TYPE_PRODUCT:
        $result = array_merge($result, $this->generateServerParams($cartProduct));
        break;
      case ShopProduct::TYPE_DOMAIN:
        $result = array_merge($result, $this->generateDomainParams($cartProduct));
        break;
    }

    foreach($cartProduct->getDecodedParams() as $key => $additionalField)
    {
      // Fill in the value in case it exists in Params and not yet field in the result
      if(!empty($additionalField) && empty($result[$key]))
      {
        $result[$key] = $additionalField;
      }
    }
    return $result;
  }

  /**
   * Generate params for product with type Product
   *
   * @param $cartProduct
   * @return array Params
   */
  protected function generateServerParams($cartProduct)
  {
    return [
      'pid' => $cartProduct->getWhmcsPid(),
      'billingcycle' => $cartProduct->getPeriod(),
    ];
  }

  /**
   * Generate params for product with type Domain
   *
   * @param $cartProduct
   * @return array Params
   */
  protected function generateDomainParams($cartProduct)
  {
    return [
      'domain' => $cartProduct->getDomainNameWithTld(),
      'domaintype' => "register",
      'regperiod' => $cartProduct->getPeriod(),
    ];
  }
}
