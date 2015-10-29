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
    // Current user currency to use in View
    $this->currentCurrency = PluginWhmcsConnection::initConnection()->getCurrencies()->findByCode($this->getUser()->getCurrency());

    // Get current category from route
    $this->category = $this->getRoute()->getObject();
    // Get all category products (and domains)
    $this->products = $this->category->getProducts();

    $this->productForms = [];
    foreach($this->products as $product)
    {
      $cartProduct = new CartProduct();
      $cartProduct->fromArray([
        'category_id' => $this->category->getId(),
        'whmcs_pid' => $product->id,
        'type' => $product->type,
      ]);
      $form = new CartProductForm(
        $cartProduct,
        [
          'currency' => $this->getUser()->getCurrencyId(),
        ]
      );
      $product->form = $form;
    }

    // TODO: Refactoring required.
    $request->setAttribute('objectId', $this->category->getId());
    $request->setAttribute('objectClass', 'ShopCategory');
    $request->setAttribute('objectRoute', 'category');
  }
}
