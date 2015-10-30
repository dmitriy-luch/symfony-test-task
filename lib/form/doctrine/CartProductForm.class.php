<?php

/**
 * CartProduct form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CartProductForm extends BaseCartProductForm
{
  protected $user;

  const FORM_NAME = 'cart_product';

  public function __construct($object = null, $options = array(), $CSRFSecret = null)
  {
    if(!isset($options['user']))
    {
      // TODO: Consider throwing an exception in case no user is provided
    }
    if(!isset($options['request']))
    {
      // TODO: Consider throwing an exception in case no request is provided
    }
    if(!isset($options['response']))
    {
      // TODO: Consider throwing an exception in case no response is provided
    }

    parent::__construct($object, $options, $CSRFSecret);
  }
  public function configure()
  {
    $type = $this->getObject()->getType();
    $whmcsId = $this->getObject()->getWhmcsPid();

    $this->setWidget('category_id', new sfWidgetFormInputHidden());
    $this->setWidget('whmcs_pid', new sfWidgetFormInputHidden());
    $this->setWidget('cart_id', new sfWidgetFormInputHidden());
    $this->setWidget('type', new sfWidgetFormInputHidden());
    $shopProduct = ShopProduct::findOneByTypeAndId($type, $whmcsId);
    $billingPeriods = [];
    if($shopProduct)
    {
      $billingPeriods = $shopProduct->getPrices($this->options['currency']);
    }
    $this->setWidget('period', new sfWidgetFormChoice(['choices' => $billingPeriods]));
    $this->setWidget('params', new sfWidgetFormInputHidden());

    $this->setValidators(array(
        'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
        'category_id' => new sfValidatorInteger(),
        'cart_id'     => new sfValidatorInteger(['required' => false]),
        'whmcs_pid'   => new sfValidatorInteger(),
        'type'        => new sfValidatorString(array('required' => true)),
        'period'      => new sfValidatorChoice(['required' => true, 'choices' => array_keys($billingPeriods)]),
        'params'      => new sfValidatorString(array('required' => false)),
        'action'      => new sfValidatorChoice(['required' => true, 'choices' => ['Update', 'Delete', 'Add']]),
    ));

    if($type == 'domain')
    {
      $this->widgetSchema['params'] = new sfWidgetFormInputText(['label' => 'Domain name']);
      $this->validatorSchema['params'] = new sfValidatorAnd(
        [
          new sfValidatorPass(['required' => true]),
          $this->validatorSchema['params']
        ]
      );
    }

    $this->widgetSchema->setNameFormat(self::FORM_NAME . '[%s]');
  }

  public function updateCartIdColumn($value)
  {
    if($value)
    {
      return $value;
    }
    // Get current user cart or create new
    $cart = $this->getOption('user')
        ->getCartOrCreate(
          [
            'request' => $this->getOption('request'),
            'response' => $this->getOption('response'),
          ]
        );
    if(!$cart){
      // TODO: Add error to form if possible or throw an exception
    }
    return $cart->getId();
  }
}
