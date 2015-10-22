<?php

class myUser extends sfBasicSecurityUser
{
  public function getCurrency()
  {
    $currentCurrency = sfConfig::get('app_default_currency', null);
    if($this->hasAttribute('currency'))
    {
      $currentCurrency = $this->getAttribute('currency');
    }
    return $currentCurrency;
  }

  public function setCurrency($currency)
  {
    $this->setAttribute('currency', $currency);
  }
}
