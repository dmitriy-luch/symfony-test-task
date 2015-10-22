<?php

class myUser extends sfBasicSecurityUser
{
  public function __construct(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::__construct($dispatcher, $storage, $options);

    $dispatcher = frontendConfiguration::getActive()->getEventDispatcher();
    $dispatcher->connect('user.pre_change_culture', array($this, 'listenToPreChangeCultureEvent'));
  }

  public function getCurrency()
  {
    $currentCurrency = sfConfig::get('app_default_currency', null);
    if($this->hasAttribute('currency'))
    {
      $currentCurrency = $this->getAttribute('currency');
    }
    return $currentCurrency;
  }

  public function getHistoryCurrency($clearHistory = true)
  {
    $historyCurrency = null;
    if($this->hasAttribute('currency'))
    {
      $historyCurrency = $this->getAttribute('historyCurrency');
      if($clearHistory)
      {
        $this->setAttribute('historyCurrency', null);
      }
    }
    return $historyCurrency;
  }

  public function setCurrency($currency)
  {
    $this->setAttribute('currency', $currency);
  }

  public function listenToPreChangeCultureEvent(sfEvent $event)
  {
    $parameters = $event->getParameters();
    if(!isset($parameters['culture']))
    {
      // TODO: Log warning
    }
    else
    {
      $this->setAttribute('historyCurrency', $parameters['currency']);
    }
  }
}
