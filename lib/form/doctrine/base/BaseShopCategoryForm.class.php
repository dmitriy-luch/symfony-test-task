<?php

/**
 * ShopCategory form base class.
 *
 * @method ShopCategory getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseShopCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'is_shown_on_frontend' => new sfWidgetFormInputCheckbox(),
      'is_popular'           => new sfWidgetFormInputCheckbox(),
      'include_domains'      => new sfWidgetFormInputCheckbox(),
      'special'              => new sfWidgetFormInputCheckbox(),
      'image'                => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'slug'                 => new sfWidgetFormInputText(),
      'shop_groups_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ShopGroup')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_shown_on_frontend' => new sfValidatorBoolean(array('required' => false)),
      'is_popular'           => new sfValidatorBoolean(array('required' => false)),
      'include_domains'      => new sfValidatorBoolean(array('required' => false)),
      'special'              => new sfValidatorBoolean(array('required' => false)),
      'image'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
      'slug'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shop_groups_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ShopGroup', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ShopCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('shop_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShopCategory';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['shop_groups_list']))
    {
      $this->setDefault('shop_groups_list', $this->object->ShopGroups->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveShopGroupsList($con);

    parent::doSave($con);
  }

  public function saveShopGroupsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['shop_groups_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ShopGroups->getPrimaryKeys();
    $values = $this->getValue('shop_groups_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ShopGroups', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ShopGroups', array_values($link));
    }
  }

}
