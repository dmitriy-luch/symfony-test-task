<?php

class languageComponents extends sfComponents
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
  }
}