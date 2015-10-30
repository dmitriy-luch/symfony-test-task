<?php

/**
 * CartProduct form base class.
 *
 * @method CartProduct getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCartProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'cart_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'), 'add_empty' => false)),
      'category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCategory'), 'add_empty' => false)),
      'whmcs_pid'   => new sfWidgetFormInputText(),
      'type'        => new sfWidgetFormTextarea(),
      'period'      => new sfWidgetFormTextarea(),
      'params'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cart_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'))),
      'category_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCategory'))),
      'whmcs_pid'   => new sfValidatorInteger(),
      'type'        => new sfValidatorString(array('required' => false)),
      'period'      => new sfValidatorString(array('required' => false)),
      'params'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cart_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CartProduct';
  }

}
