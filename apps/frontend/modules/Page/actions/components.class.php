<?php

class PageComponents extends sfComponents
{
  public function executeMenu(sfWebRequest $request)
  {
    $currentUri = $request->getUri();
    $pages = Doctrine::getTable('Page')->findAll();
    $this->menuItems = [];
    foreach($pages as $page)
    {
      $url = url_for('page', $page);
      $isCurrent = (($urlLength = strlen($currentUri) - strlen($url)) >= 0 && strpos($currentUri, $url, $urlLength));
      $this->menuItems[] = [
        'url' => $url,
        'title' => $page->getTitle(),
        'active' => $isCurrent,
      ];
    }
  }
}