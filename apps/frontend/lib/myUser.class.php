<?php

class myUser extends sfBasicSecurityUser
{
  const COOKIE_CART_ID_KEY = 'cartId';
  const SESSION_CART_KEY = 'cart';

  public function __construct(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::__construct($dispatcher, $storage, $options);

    $dispatcher = frontendConfiguration::getActive()->getEventDispatcher();
    $dispatcher->connect('user.pre_change_culture', [$this, 'listenToPreChangeCultureEvent']);
    $dispatcher->connect('cartProduct.changed', [$this, 'listenToCartProductChangeMade']);
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

  /**
   * TODO: Check is this method is still required
   *
   * @param bool|true $clearHistory
   * @return null
   */
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

  /**
   * TODO: Check is this method is still required
   *
   * @param sfEvent $event
   */
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

  /**
   * Listener to CartProduct items changes
   * Re-calculates cart total
   *
   * @param sfEvent $event
   */
  public function listenToCartProductChangeMade(sfEvent $event)
  {
    // TODO: Remove this check once changing of cart products is restricted to owner only
    if($event->getSubject()->getCartId() == $this->getCart()->getId())
    {
      // TODO: Optimization required. Instead of re-calculation + or - can be used.
      $this->getCart()->truncateCartTotal();
    }
  }

  /**
   * Get Cart item for current user
   *
   * @param null $request
   * @return null|ShopCart Cart object or null if no cart exists
   */
  public function getCart($request = null)
  {
    if(!$this->hasAttribute(self::SESSION_CART_KEY) && $request)
    {
      // Get cart from cookie when no cart exists in session and request is provided in params
      $this->loadCartFromCookie($request);
    }
    if(!$this->hasAttribute(self::SESSION_CART_KEY))
    {
      // Return null when no cart exists and none was loaded from cookie
      return null;
    }

    return $this->getAttribute(self::SESSION_CART_KEY);
  }

  /**
   * Create new cart and save it to Session.
   * Save cart ID to cookie
   *
   * @param $response
   * @return ShopCart
   */
  public function createCart($response)
  {
    // Create new cart
    $cart = new ShopCart();
    $cart->save();
    $cartId = $cart->getId();
    // Save to session
    $this->setAttribute(self::SESSION_CART_KEY, $cart);
    // Save cart ID to cookie
    $this->setCartToCookie($response, $cartId);
    // Return cart
    return $cart;
  }

  /**
   * Get current user cart or create new one
   *
   * @param $params
   * @return null|ShopCart Cart item or null if none exists and none was created
   * @throws Exception When no response or request params are provided
   */
  public function getCartOrCreate($params)
  {
    if(empty($params['request']) || empty($params['response']))
    {
      throw new Exception('Request and Response parameters are required.');
    }

    $cart = $this->getCart($params['request']);
    if(!$cart)
    {
      // Create new cart when no cart exists for current user
      $cart = $this->createCart($params['response']);
    }
    return $cart;
  }

  /**
   * Load cart ID from cookie and get cart item from DB
   * @param $request
   */
  protected function loadCartFromCookie($request)
  {
    $cartId = $request->getCookie(self::COOKIE_CART_ID_KEY);
    $cart = Doctrine::getTable('ShopCart')->findOneById(base64_decode($cartId));
    $this->setAttribute(self::SESSION_CART_KEY, $cart);
  }

  /**
   * Save cart ID to cookie
   *
   * @param $response
   * @param $cartId
   */
  protected function setCartToCookie($response, $cartId)
  {
    $response->setCookie(self::COOKIE_CART_ID_KEY, base64_encode($cartId));
  }

  /**
   * Get Currency object based on currency ID
   *
   * @return mixed
   */
  public function getCurrencyObject()
  {
    return PluginWhmcsConnection::initConnection()
        ->getCurrencies()
        ->findByCode($this->getCurrency());
  }

  public function removeCart($response)
  {
    $cart = $this->getCart();
    if($cart)
    {
      $cart->delete();
      // Remove from session
      $this->setAttribute(self::SESSION_CART_KEY, null);
      // Remove from cookie
      $this->setCartToCookie($response, null);
    }
  }
}
