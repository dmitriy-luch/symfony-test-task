<?php

/**
 * TransUnit filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTransUnitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cat_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'add_empty' => true)),
      'source'        => new sfWidgetFormFilterInput(),
      'target'        => new sfWidgetFormFilterInput(),
      'comments'      => new sfWidgetFormFilterInput(),
      'date_added'    => new sfWidgetFormFilterInput(),
      'date_modified' => new sfWidgetFormFilterInput(),
      'author'        => new sfWidgetFormFilterInput(),
      'translated'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'cat_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catalogue'), 'column' => 'cat_id')),
      'source'        => new sfValidatorPass(array('required' => false)),
      'target'        => new sfValidatorPass(array('required' => false)),
      'comments'      => new sfValidatorPass(array('required' => false)),
      'date_added'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_modified' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author'        => new sfValidatorPass(array('required' => false)),
      'translated'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('trans_unit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransUnit';
  }

  public function getFields()
  {
    return array(
      'msg_id'        => 'Number',
      'cat_id'        => 'ForeignKey',
      'source'        => 'Text',
      'target'        => 'Text',
      'comments'      => 'Text',
      'date_added'    => 'Number',
      'date_modified' => 'Number',
      'author'        => 'Text',
      'translated'    => 'Boolean',
    );
  }
}
