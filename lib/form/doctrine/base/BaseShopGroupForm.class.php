<?php

/**
 * ShopGroup form base class.
 *
 * @method ShopGroup getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseShopGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'name'                 => new sfWidgetFormTextarea(),
      'orderfrmtpl'          => new sfWidgetFormTextarea(),
      'disabledgateways'     => new sfWidgetFormTextarea(),
      'hidden'               => new sfWidgetFormTextarea(),
      'order'                => new sfWidgetFormInputText(),
      'shop_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ShopCategory')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                 => new sfValidatorString(array('required' => false)),
      'orderfrmtpl'          => new sfValidatorString(array('required' => false)),
      'disabledgateways'     => new sfValidatorString(array('required' => false)),
      'hidden'               => new sfValidatorString(array('required' => false)),
      'order'                => new sfValidatorPass(array('required' => false)),
      'shop_categories_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ShopCategory', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shop_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShopGroup';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['shop_categories_list']))
    {
      $this->setDefault('shop_categories_list', $this->object->ShopCategories->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveShopCategoriesList($con);

    parent::doSave($con);
  }

  public function saveShopCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['shop_categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ShopCategories->getPrimaryKeys();
    $values = $this->getValue('shop_categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ShopCategories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ShopCategories', array_values($link));
    }
  }

}
