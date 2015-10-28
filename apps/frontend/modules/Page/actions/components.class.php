<?php

class PageComponents extends sfComponents
{
  public function executeMenu(sfWebRequest $request)
  {
    $this->pages = Doctrine::getTable('Page')->findAll();
  }
}