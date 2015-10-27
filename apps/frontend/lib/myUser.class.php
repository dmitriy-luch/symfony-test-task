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

  /**
   * Current User currency WHMCS id
   *
   * @return int WHMCS id
   */
  public function getCurrencyId()
  {
    return (int)PluginWhmcsConnection::initConnection()->getCurrencies()->findByCode($this->getCurrency())->id;
  }

  public function getHistoryCultrure($clearHistory = true)
  {
    $historyCulture = null;
    if($this->hasAttribute('historyCulture'))
    {
      $historyCulture = $this->getAttribute('historyCulture');
      if($clearHistory)
      {
        $this->setAttribute('historyCulture', null);
      }
    }
    return $historyCulture;
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
      $this->setAttribute('historyCulture', $parameters['culture']);
    }
  }
}
