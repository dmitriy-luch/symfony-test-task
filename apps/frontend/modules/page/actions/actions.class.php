<?php

/**
 * page actions.
 *
 * @package    shop
 * @subpackage page
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pageActions extends sfActions
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
    $this->currencies = PluginWhmcsConnection::initConnection()->getCurrencies();
  }
}
