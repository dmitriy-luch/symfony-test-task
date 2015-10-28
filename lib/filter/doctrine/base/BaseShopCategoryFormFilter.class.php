<?php

/**
 * ShopCategory filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseShopCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_shown_on_frontend' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_popular'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'include_domains'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'special'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'image'                => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'shop_groups_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ShopGroup')),
    ));

    $this->setValidators(array(
      'is_shown_on_frontend' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_popular'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'include_domains'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'special'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'image'                => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'shop_groups_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ShopGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shop_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addShopGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('CategoryRelations.whmcs_gid', $values)
    ;
  }

  public function getModelName()
  {
    return 'ShopCategory';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'is_shown_on_frontend' => 'Boolean',
      'is_popular'           => 'Boolean',
      'include_domains'      => 'Boolean',
      'special'              => 'Boolean',
      'image'                => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'shop_groups_list'     => 'ManyKey',
    );
  }
}
