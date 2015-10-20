<?php

class languageComponents extends sfComponents
{
  public function executeLanguage(sfWebRequest $request)
  {

    $this->form = new sfFormLanguage(
        $this->getUser(),
        [
          'languages' => ['en', 'ru'],
        ]
    );
    $this->form->setDefault('redirect', $this->getVar('redirect'));
    $this->form->setWidget('redirect', new sfWidgetFormInputHidden());
  }
}