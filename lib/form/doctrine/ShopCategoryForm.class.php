<?php

/**
 * Category form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopCategoryForm extends BaseShopCategoryForm
{
  /**
   * {@inheritdoc}
   */
  public function configure()
  {
    // Unsetting created at and updated at fields since they are filled in by behaviour
    unset($this['created_at'], $this['updated_at']);

    // Set editable file widget for Image field
    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
        'file_src'  => $this->getObject()->getWebImagePath(true),
        'is_image'  => true,
        'edit_mode' => !$this->isNew(),
    ));

    // Set File validator for Image field
    $this->validatorSchema['image'] = new sfValidatorFile(array(
        'path' => $this->getObject()->getUploadRootDir(),
        'required' => false,
    ));

    // Add Image delete validator. Required by Editable File Input
    $this->validatorSchema['image_delete'] = new sfValidatorPass();

    // Get all enabled cultures from config
    $this->languages = sfConfig::get('app_cultures_enabled', []);
    // Get Language codes
    $languageCodes = array_keys($this->languages);
    // Embed i18n form with the codes above
    $this->embedI18n($languageCodes);

    // Loop through each language in form
    foreach($this->languages as $languageCode => $languageName)
    {
      // Set label for each language form from config
      $this->widgetSchema[$languageCode]->setLabel($languageName);
    }
  }

  /**
   * {@inheritdoc}
   */
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

  /**
   * {@inheritdoc}
   */
  protected function doSave($con = null)
  {
    $this->updateSpecials($con);

    parent::doSave($con);
  }

  /**
   * Remove previous Special Category
   *
   * @param null $con Non used. Provided for compatibility
   */
  protected function updateSpecials($con = null)
  {
    // Check if Category is marked as Special and it was not special earlier
    if($this->getValidator('special') && !$this->getObject()->getSpecial())
    {
      // Execute remove specials method from Category table
      Doctrine::getTable('ShopCategory')->removeSpecials();
    }
  }
}
