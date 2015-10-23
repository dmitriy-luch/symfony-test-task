<?php

/**
 * Category form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
        'file_src'  => $this->getObject()->getWebImagePath(true),
        'is_image'  => true,
        'edit_mode' => !$this->isNew(),
    ));

    $this->validatorSchema['image'] = new sfValidatorFile(array(
        'path' => $this->getObject()->getUploadRootDir(),
        'required' => false,
    ));

    $this->validatorSchema['image_delete'] = new sfValidatorPass();


    $this->languages = sfConfig::get('app_cultures_enabled', []);

    $languageCodes = array_keys($this->languages);
    $this->embedI18n($languageCodes);
    foreach($this->languages as $languageCode => $languageName)
    {
      $this->widgetSchema[$languageCode]->setLabel($languageName);
    }
  }

  protected function processUploadedFile($field, $filename = null, $values = null)
  {
    // Remove old thumbnail in case Delete checkbox is checked
    if($this->getValue('image_delete'))
    {
      $this->getObject()->removeThumbnail();
    }

    // Proceed with common uploaded file process
    $uploadedFileName = parent::processUploadedFile($field, $filename, $values);

    // Generate new thumbnail in case new image is uploaded
    if($uploadedFileName != "")
    {
      $this->getObject()->generateThumbnail($uploadedFileName);
    }

    // Return result of the default uploaded file process
    return $uploadedFileName;
  }
}
