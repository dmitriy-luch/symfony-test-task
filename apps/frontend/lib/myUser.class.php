<?php

class myUser extends sfBasicSecurityUser
{
  public function __construct(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::__construct($dispatcher, $storage, $options);

    $dispatcher = frontendConfiguration::getActive()->getEventDispatcher();
    $dispatcher->connect('user.pre_change_culture', array($this, 'listenToPreChangeCultureEvent'));
  }

  /**
   * Get user currency from session or use default from config
   *
   * @return string|null Currency Code
   */
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
    $currency = PluginWhmcsConnection::initConnection()->getCurrencies()->findByCode($this->getCurrency());
    if(!$currency)
    {
      // No WHMCS currency found.
      // TODO: Consider changing user currency at this point
      return null;
    }
    return (int)$currency->id;
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

  /**
   * Set user currency in session
   *
   * @param $currency string
   */
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

  public function getCart($request = null)
  {
    if(!$this->hasAttribute('cart') && $request)
    {
      $this->loadCartFromCookie($request);
    }
    if(!$this->hasAttribute('cart'))
    {
      return null;
    }

    $cartToken = $this->getAttribute('cart');
    return Doctrine::getTable('ShopCart')->findOneById($cartToken);
  }

  public function createCart($response)
  {
    // Create new cart
    $cart = new ShopCart();
    $cart->save();
    $cartToken = $cart->getId();
    // Save to session
    $this->setAttribute('cart', $cartToken);
    // Save to cookie
    $this->setCartToCookie($response, $cartToken);
    // Return cart token
    return $cartToken;
  }

  protected function loadCartFromCookie($request)
  {
    $cart = $request->getCookie('cart');
    $this->setAttribute('cart', base64_decode($cart));
  }

  protected function setCartToCookie($response, $cart)
  {
    $response->setCookie('cart', base64_encode($cart));
  }
}
