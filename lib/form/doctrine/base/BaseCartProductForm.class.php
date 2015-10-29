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
      'cart_id'     => new sfWidgetFormInputText(),
      'category_id' => new sfWidgetFormInputText(),
      'whmcs_pid'   => new sfWidgetFormInputText(),
      'type'        => new sfWidgetFormTextarea(),
      'period'      => new sfWidgetFormTextarea(),
      'params'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cart_id'     => new sfValidatorInteger(),
      'category_id' => new sfValidatorInteger(),
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
