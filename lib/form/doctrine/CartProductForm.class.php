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
  public function configure()
  {
    $type = $this->getObject()->getType();
    $whmcsId = $this->getObject()->getWhmcsPid();

    $this->setWidget('category_id', new sfWidgetFormInputHidden());
    $this->setWidget('whmcs_pid', new sfWidgetFormInputHidden());
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
        'whmcs_pid'   => new sfValidatorInteger(),
        'type'        => new sfValidatorString(array('required' => true)),
        'period'      => new sfValidatorChoice(['required' => true, 'choices' => array_keys($billingPeriods)]),
        'params'      => new sfValidatorString(array('required' => false)),
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

//    $this->widgetSchema->setNameFormat('cart_product' . $whmcsId . $type . '[%s]');
    $this->widgetSchema->setNameFormat('cart_product[%s]');
  }
}
