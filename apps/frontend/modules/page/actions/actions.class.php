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
  }
}
