<?php

/**
 * Catalogue filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCatalogueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'source_lang'   => new sfWidgetFormFilterInput(),
      'target_lang'   => new sfWidgetFormFilterInput(),
      'date_created'  => new sfWidgetFormFilterInput(),
      'date_modified' => new sfWidgetFormFilterInput(),
      'author'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'source_lang'   => new sfValidatorPass(array('required' => false)),
      'target_lang'   => new sfValidatorPass(array('required' => false)),
      'date_created'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_modified' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogue_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogue';
  }

  public function getFields()
  {
    return array(
      'cat_id'        => 'Number',
      'name'          => 'Text',
      'source_lang'   => 'Text',
      'target_lang'   => 'Text',
      'date_created'  => 'Number',
      'date_modified' => 'Number',
      'author'        => 'Text',
    );
  }
}
