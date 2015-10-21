<?php

/**
 * Catalogue form base class.
 *
 * @method Catalogue getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCatalogueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cat_id'        => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'source_lang'   => new sfWidgetFormInputText(),
      'target_lang'   => new sfWidgetFormInputText(),
      'date_created'  => new sfWidgetFormInputText(),
      'date_modified' => new sfWidgetFormInputText(),
      'author'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cat_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cat_id')), 'empty_value' => $this->getObject()->get('cat_id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'source_lang'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'target_lang'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'date_created'  => new sfValidatorInteger(array('required' => false)),
      'date_modified' => new sfValidatorInteger(array('required' => false)),
      'author'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catalogue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catalogue';
  }

}
