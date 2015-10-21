<?php

/**
 * TransUnit form base class.
 *
 * @method TransUnit getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransUnitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'msg_id'        => new sfWidgetFormInputHidden(),
      'cat_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'add_empty' => true)),
      'source'        => new sfWidgetFormTextarea(),
      'target'        => new sfWidgetFormTextarea(),
      'comments'      => new sfWidgetFormTextarea(),
      'date_added'    => new sfWidgetFormInputText(),
      'date_modified' => new sfWidgetFormInputText(),
      'author'        => new sfWidgetFormInputText(),
      'translated'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'msg_id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('msg_id')), 'empty_value' => $this->getObject()->get('msg_id'), 'required' => false)),
      'cat_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catalogue'), 'required' => false)),
      'source'        => new sfValidatorString(array('required' => false)),
      'target'        => new sfValidatorString(array('required' => false)),
      'comments'      => new sfValidatorString(array('required' => false)),
      'date_added'    => new sfValidatorInteger(array('required' => false)),
      'date_modified' => new sfValidatorInteger(array('required' => false)),
      'author'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'translated'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trans_unit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransUnit';
  }

}
