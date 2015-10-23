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
      'type'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'whmcs_gid'   => new sfWidgetFormFilterInput(),
      'category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'type'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'whmcs_gid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Category'), 'column' => 'id')),
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
      'type'        => 'Number',
      'whmcs_gid'   => 'Number',
      'category_id' => 'ForeignKey',
    );
  }
}
