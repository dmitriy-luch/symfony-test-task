<?php

/**
 * ShopCartProductRelations form base class.
 *
 * @method ShopCartProductRelations getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseShopCartProductRelationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'cart_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'), 'add_empty' => false)),
      'product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CartProduct'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cart_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'))),
      'product_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CartProduct'))),
    ));

    $this->widgetSchema->setNameFormat('shop_cart_product_relations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShopCartProductRelations';
  }

}
