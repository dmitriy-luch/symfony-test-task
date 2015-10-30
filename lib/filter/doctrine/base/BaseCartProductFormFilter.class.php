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
      'cart_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCart'), 'add_empty' => true)),
      'category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCategory'), 'add_empty' => true)),
      'whmcs_pid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'        => new sfWidgetFormFilterInput(),
      'period'      => new sfWidgetFormFilterInput(),
      'params'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cart_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopCart'), 'column' => 'id')),
      'category_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopCategory'), 'column' => 'id')),
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
      'cart_id'     => 'ForeignKey',
      'category_id' => 'ForeignKey',
      'whmcs_pid'   => 'Number',
      'type'        => 'Text',
      'period'      => 'Text',
      'params'      => 'Text',
    );
  }
}
