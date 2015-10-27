<?php

/**
 * CategoryRelations filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoryRelationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'whmcs_gid'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopGroup'), 'add_empty' => true)),
      'category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopCategory'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'whmcs_gid'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopGroup'), 'column' => 'id')),
      'category_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopCategory'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('category_relations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryRelations';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'whmcs_gid'   => 'ForeignKey',
      'category_id' => 'ForeignKey',
    );
  }
}
