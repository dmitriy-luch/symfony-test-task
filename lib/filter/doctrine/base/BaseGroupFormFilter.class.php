<?php

/**
 * Group filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGroupFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                 => new sfWidgetFormFilterInput(),
      'orderfrmtpl'          => new sfWidgetFormFilterInput(),
      'disabledgateways'     => new sfWidgetFormFilterInput(),
      'hidden'               => new sfWidgetFormFilterInput(),
      'order'                => new sfWidgetFormFilterInput(),
      'shop_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ShopCategory')),
    ));

    $this->setValidators(array(
      'name'                 => new sfValidatorPass(array('required' => false)),
      'orderfrmtpl'          => new sfValidatorPass(array('required' => false)),
      'disabledgateways'     => new sfValidatorPass(array('required' => false)),
      'hidden'               => new sfValidatorPass(array('required' => false)),
      'order'                => new sfValidatorPass(array('required' => false)),
      'shop_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ShopCategory', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addShopCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.CategoryRelations CategoryRelations')
      ->andWhereIn('CategoryRelations.category_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Group';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'name'                 => 'Text',
      'orderfrmtpl'          => 'Text',
      'disabledgateways'     => 'Text',
      'hidden'               => 'Text',
      'order'                => 'Text',
      'shop_categories_list' => 'ManyKey',
    );
  }
}
