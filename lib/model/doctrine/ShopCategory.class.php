<?php

/**
 * ShopCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShopCategory extends BaseShopCategory
{
  public function generateThumbnail($uploadedFileName = null)
  {
    if(!$uploadedFileName)
    {
      $uploadedFileName = $this->getImage();
    }
    $thumbnail = new sfThumbnail(sfConfig::get('app_category_thumbnail_width', 90), sfConfig::get('app_category_thumbnail_height', 90));
    $thumbnail->loadFile($this->getUploadRootDir() . DIRECTORY_SEPARATOR . $uploadedFileName);
    $thumbnail->save($this->getUploadRootDir(true) . DIRECTORY_SEPARATOR . $uploadedFileName);
  }

  public function removeThumbnail()
  {
    $thumbnailFileName = $this->getAbsoluteImagePath(true);
    if(file_exists($thumbnailFileName)){
      return unlink($thumbnailFileName);
    }

    // TODO: Log error since file not found
    return false;
  }

  public function getAbsoluteImagePath($thumbnail = false)
  {
    $result = $this->getImage();
    if(null !== $result)
    {
      $result = $this->getUploadRootDir($thumbnail) . '/' . $result;
    }
    return $result;
  }

  public function getWebImagePath($thumbnail = false)
  {
    $result = $this->getImage();
    if(null !== $result)
    {
      $result = $this->getUploadDir($thumbnail) . '/' . $result;
    }
    return $result;
  }

  public function getUploadRootDir($thumbnail = false)
  {
    return sfConfig::get('sf_web_dir') . $this->getUploadDir($thumbnail);
  }

  public function getUploadDir($thumbnail = false)
  {
    if($thumbnail)
    {
      return sfConfig::get('app_category_upload_dir_thumbnail', '/uploads/categories/thumbnail');
    }
    return sfConfig::get('app_category_upload_dir', '/uploads/categories');
  }

  /**
   * Current Category WHMCS Group Ids
   *
   * @return array WHMCS Group Ids
   */
  public function getGroupIds()
  {
    return $this->getShopGroups()->getPrimaryKeys();
  }

  // Leaving commented since it might be useful in future
//  public function getProductInternals()
//  {
//    $query = Doctrine::getTable('WhmcsProductInternal')
//        ->createQuery('p')
//        ->andWhereIn('gid', $this->getGroupIds());
//    return $query->execute();
//  }
  // End of commented code

  /**
   * Cheapest price among all Category Group Products (and Domains)
   *
   * @param $currency WHMCS Currency ID
   * @return mixed Price
   */
  public function getCheapestPrice($currency)
  {
    $config = [
        'groups' => $this->getGroupIds(),
        'domains' => $this->getIncludeDomains(),
        'currency' => $currency,
    ];

    $result = Doctrine::getTable('WhmcsPrice')->getCheapestProductsPrices($config);
    $cheapest = reset($result);
    // TODO: Save value to cache for further usage
    return $cheapest;
  }
}
