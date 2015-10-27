<?php

/**
 * Page actions.
 *
 * @package    shop
 * @subpackage Page
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PageActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();
    $response = $this->getResponse();
    $response->setTitle($this->page->getTitle());
    $response->addMeta('description', $this->page->getMetaDescription());
    $response->addMeta('keywords', $this->page->getMetaDescription());
  }

  public function executeIndex(sfWebRequest $request)
  {
    // Current user currency to use in View
    $this->currentCurrency = PluginWhmcsConnection::initConnection()->getCurrencies()->findByCode($this->getUser()->getCurrency());
    // All frontend categories
    $this->categories = Doctrine::getTable('ShopCategory')->findAllFrontend(sfConfig::get('app_homepage_categories_count', 3));
  }
}
