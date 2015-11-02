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
      $this->embedRelation('CartProducts', 'CartProductForm', [

          [
            'request' => $this->options['request'],
            'response' => $this->options['response'],
            'user' => $this->options['user'],
            'action' => CartProductForm::ACTION_UPDATE,
          ]
      ]);
    }
  }
}
