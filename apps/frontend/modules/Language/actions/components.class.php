<?php

class LanguageComponents extends sfComponents
{
  public function executeLanguage(sfWebRequest $request)
  {
    $languages = sfConfig::get('app_cultures_enabled', []);
    $languageCodes = array_keys($languages);

    $this->form = new sfFormLanguageCustom(
        $this->getUser(),
        [
          'languages' => $languageCodes,
        ]
    );
    $this->form->setDefault('currentPage', $this->getVar('currentPage'));
    $this->form->setDefault('objectId', $this->getVar('objectId'));
    $this->form->setDefault('objectClass', $this->getVar('objectClass'));
    $this->form->setDefault('objectRoute', $this->getVar('objectRoute'));
  }
}