<?php

class sfFormLanguageCustom extends sfFormLanguage
{
  public function configure()
  {
    parent::configure();
    $this->setWidget('currentPage', new sfWidgetFormInputHidden());
    $this->setValidator('currentPage', new sfValidatorUrl());
  }

  public function process(sfRequest $request)
  {
    $data = [
        'language' => $request->getParameter('language'),
        'currentPage' => $request->getParameter('currentPage'),
    ];
    if ($request->hasParameter(self::$CSRFFieldName))
    {
      $data[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
    }

    $this->bind($data);

    if ($isValid = $this->isValid())
    {
      $this->save();
    }

    return $isValid;
  }
}