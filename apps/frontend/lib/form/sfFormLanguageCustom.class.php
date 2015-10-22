<?php

class sfFormLanguageCustom extends sfFormLanguage
{
  public function configure()
  {
    parent::configure();

    // Required to redirect users to the correct page after language change
    $this->setWidget('currentPage', new sfWidgetFormInputHidden());
    $this->setValidator('currentPage', new sfValidatorUrl());

    // Required to store user's currency
    $currentCurrency = $this->user->getCurrency();

    $this->setDefault('currency', $currentCurrency);
    $currencyChoices = PluginWhmcsConnection::initConnection()->getCurrencies()->values();
    $this->setValidator('currency', new sfValidatorChoice(['choices' => $currencyChoices]));

    $this->setWidget('currency', new sfWidgetFormChoice(['choices' => $currencyChoices]));
  }

  public function process(sfRequest $request)
  {
    $data = [
        'language' => $request->getParameter('language'),
        'currentPage' => $request->getParameter('currentPage'),
        'currency' => $request->getParameter('currency'),
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

  public function save()
  {
    // Notifying of culture change before the actual culture change
    $event = new sfEvent(null, 'user.pre_change_culture', array('culture' => $this->user->getCulture()));
    $dispatcher = frontendConfiguration::getActive()->getEventDispatcher();
    $dispatcher->notify($event);

    parent::save();
    $this->user->setCurrency($this->getValue('currency'));
  }
}