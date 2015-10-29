<?php

/**
 * ShopCart filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseShopCartFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cart_products_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'CartProduct')),
    ));

    $this->setValidators(array(
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cart_products_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'CartProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shop_cart_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCartProductsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ShopCartProductRelations ShopCartProductRelations')
      ->andWhereIn('ShopCartProductRelations.product_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'ShopCart';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'cart_products_list' => 'ManyKey',
    );
  }
}
