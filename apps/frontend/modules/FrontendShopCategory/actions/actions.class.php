<?php

/**
 * FrontendShopCategory actions.
 *
 * @package    shop
 * @subpackage FrontendShopCategory
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FrontendShopCategoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Current user currency to use in View
    $this->currentCurrency = PluginWhmcsConnection::initConnection()->getCurrencies()->findByCode($this->getUser()->getCurrency());
    // All frontend categories
    $this->categories = Doctrine::getTable('ShopCategory')->findAllFrontend(sfConfig::get('app_homepage_categories_count', 3));
  }
  /**
   * Executes show action
   *
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->category = $this->getRoute()->getObject();
    // TODO: Refactoring required.
    $request->setAttribute('objectId', $this->category->getId());
    $request->setAttribute('objectClass', 'ShopCategory');
    $request->setAttribute('objectRoute', 'category');
  }
}
