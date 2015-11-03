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
}
