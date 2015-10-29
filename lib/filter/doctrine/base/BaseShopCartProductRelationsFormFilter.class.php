<?php

/**
 * ShopCartProductRelations filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseShopCartProductRelationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cart_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'), 'add_empty' => true)),
      'product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CartProduct'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cart_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopCart'), 'column' => 'id')),
      'product_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CartProduct'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('shop_cart_product_relations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShopCartProductRelations';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'cart_id'    => 'ForeignKey',
      'product_id' => 'ForeignKey',
    );
  }
}
