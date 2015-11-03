<?php

/**
 * ShopCart form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopCartForm extends BaseShopCartForm
{
  public function __construct($object = null, $options = array(), $CSRFSecret = null)
  {
    if(empty($options['user']) || empty($options['request']) || empty($options['response']))
    {
      // User, Request and Response are required to build product form
      throw new Exception('user, request and response are required');
    }

    parent::__construct($object, $options, $CSRFSecret);
  }

  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);
    foreach($this->getObject()->getCartProducts() as $key => $cartProduct)
    {
      $this->embedRelation(
        'CartProducts',
        'CartProductForm',
        [
          [
            'request' => $this->options['request'],
            'response' => $this->options['response'],
            'user' => $this->options['user'],
            'action' => CartProductForm::ACTION_UPDATE,
          ]
        ]
      );
    }

    $this->setWidget('firstname', new sfWidgetFormInputText(['label' => 'First name']));
    $this->setWidget('lastname', new sfWidgetFormInputText(['label' => 'Last name']));
    $this->setWidget('email', new sfWidgetFormInputText(['label' => 'Email']));
    $this->setWidget('address1', new sfWidgetFormInputText(['label' => 'Address']));
    $this->setWidget('city', new sfWidgetFormInputText());
    $this->setWidget('state', new sfWidgetFormInputText());
    $this->setWidget('postcode', new sfWidgetFormInputText(['label' => 'Post code']));
    $this->setWidget('country', new sfWidgetFormI18nChoiceCountry(['label' => 'Country (2-letter code)']));
    $this->setWidget('phonenumber', new sfWidgetFormInputText(['label' => 'Phone number']));
    $this->setWidget('password2', new sfWidgetFormInputPassword(['label' => 'Password']));

    $this->setValidator('firstname', new sfValidatorString());
    $this->setValidator('lastname', new sfValidatorString());
    $this->setValidator('email', new sfValidatorEmail());
    $this->setValidator('address1', new sfValidatorString());
    $this->setValidator('city', new sfValidatorString());
    $this->setValidator('state', new sfValidatorString());
    $this->setValidator('postcode', new sfValidatorString());
    $this->setValidator('country', new sfValidatorI18nChoiceCountry());
    $this->setValidator('phonenumber', new sfValidatorString());
    $this->setValidator('password2', new sfValidatorString());
  }
}
