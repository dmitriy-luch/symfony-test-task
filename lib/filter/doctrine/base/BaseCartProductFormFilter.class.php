<?php

/**
 * CartProduct filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCartProductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'whmcs_pid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'        => new sfWidgetFormFilterInput(),
      'period'      => new sfWidgetFormFilterInput(),
      'params'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'whmcs_pid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'        => new sfValidatorPass(array('required' => false)),
      'period'      => new sfValidatorPass(array('required' => false)),
      'params'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cart_product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CartProduct';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'category_id' => 'Number',
      'whmcs_pid'   => 'Number',
      'type'        => 'Text',
      'period'      => 'Text',
      'params'      => 'Text',
    );
  }
}
