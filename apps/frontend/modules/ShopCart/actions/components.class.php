<?php

class ShopCartComponents extends sfComponents
{
  public function executeCart(sfWebRequest $request)
  {
    $cart = $this->getUser()->getCart($request);
    // There are no products by default
    $this->productsCount = 0;
    if($cart)
    {
      // Get current cart products count in case user has a cart already
      $this->productsCount = $cart->getCartProducts()->count();
    }
    // Get cart total based on current currency
    $this->cartTotal = $cart->getCartTotal($this->getUser()->getCurrencyId());
  }
}