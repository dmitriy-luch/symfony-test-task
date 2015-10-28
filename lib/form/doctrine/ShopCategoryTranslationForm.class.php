<?php

/**
 * ShopCategoryTranslation form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopCategoryTranslationForm extends BaseShopCategoryTranslationForm
{
  public function configure()
  {
    if( ! $this->isNew() )
    {
      $this->widgetSchema['id']    = new sfWidgetFormInputHidden();
      $this->validatorSchema['id'] = new sfValidatorNumber(array(
          'required' => true,
          'min'      => 1
      ));
    }
    $this->mergePostValidator(new sfValidatorDoctrineUniqueI18n(
                [
                    'model' => 'ShopCategory',
                    'column' => ['name', 'lang'],
                ],
                [
                    'invalid' => 'This Name already exists for current language.'
                ])
    );
  }
}
