<?php

/**
 * ShopCart actions.
 *
 * @package    shop
 * @subpackage ShopCart
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopCartActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Get current cart
    $this->cart = $this->getCartOrRedirect();
    // Get cart products with forms if cart exists
    $this->products = CartProductFormBuilder::init([
      'request' => $this->getRequest(),
      'response' => $this->getResponse(),
      'user' => $this->getUser(),
      'formOptions' => [
          'action' => CartProductForm::ACTION_REMOVE,
      ]
    ])->buildFromCart($this->cart);
  }

  public function executeAddToCart(sfWebRequest $request)
  {
    // Get product with forms by provided request parameters
    $this->product = CartProductFormBuilder::init([
        'request' => $this->getRequest(),
        'response' => $this->getResponse(),
        'user' => $this->getUser(),
        'formOptions' => [
            'action' => CartProductForm::ACTION_ADD,
        ]
    ])->buildOneFromParams();
    // Check if provided params are valid
    if($isValid = $this->product->form->isValid())
    {
      // Save new product to cart
      $this->product->form->save();
      if($request->isXmlHttpRequest()){
        // Render Cart component in case of AJAX request
        return $this->renderComponent('ShopCart', 'cart');
      }
      // Redirect to cart with newly added product for non-Ajax requests
      $this->redirect('cart');
    }
    // Render just the form in case of validation errors
  }

  public function executeDeleteFromCart(sfWebRequest $request)
  {
    // Get product with forms by provided request parameters
    $product = CartProductFormBuilder::init([
        'request' => $this->getRequest(),
        'response' => $this->getResponse(),
        'user' => $this->getUser(),
        'formOptions' => [
            'action' => CartProductForm::ACTION_ADD,
        ]
    ])->buildOneFromParams();
    if(!$product->form->getObject() || !$product->form->getObject()->getId())
    {
      $this->getUser()->setFlash('error', 'Failed to delete item. Please try again.');
      // TODO: Log error
    }
    else
    {
      $this->getUser()->setFlash('success', 'Item was successfully deleted.');
      $product->form->getObject()->delete();
    }
    $this->redirect('cart');
  }

  public function executeUpdateCart(sfWebRequest $request)
  {
    $this->isExistingCustomer = $request->getParameter('existing');
    $cart = $this->getCartOrRedirect();
    $this->form = new ShopCartForm(
      $cart,
      [
        'request' => $this->getRequest(),
        'response' => $this->getResponse(),
        'user' => $this->getUser(),
        'isExistignCustomer' => $this->isExistingCustomer,
      ]
    );
    if($params = $request->getParameter($this->form->getName()))
    {
      $this->form->bind($params);
      if($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash('success', 'Cart updated successfully');
        $this->redirect('billing');
      }
      $this->getUser()->setFlash('warning', 'Cart update failed. Please try again');
    }
  }

  public function executeBilling(sfWebRequest $request)
  {
    $this->getCartOrRedirect();
    $this->form = new ShopCartBillingForm(
      null,
      [
          'user' => $this->getUser(),
      ]
    );
    if($params = $request->getParameter($this->form->getName()))
    {
      $this->form->bind($params);
      if ($this->form->isValid())
      {
        $order = $this->form->createOrder();
        if ($order)
        {
          $this->getUser()->setFlash('success', 'Order successfully created. Your order ID is #' . $order->orderid);
          $this->getUser()->removeCart($this->getResponse());
          $this->redirect('homepage');
        }

        $this->getUser()->setFlash('error', 'Order creation failed. Please try again.');
      }
    }
  }

  /**
   * Get current user cart when there is at least one product added
   * Redirect to homepage and add flash message otherwise
   *
   * @return mixed
   * @throws sfStopException
   */
  protected function getCartOrRedirect()
  {
    $cart = $this->getUser()->getCart($this->getRequest());
    if(!$cart || !$cart->getCartProducts()->count())
    {
      $this->getUser()->setFlash('warning', 'Please add at least one product to your cart first.');
      $this->redirect('homepage');
    }
    return $cart;
  }
}
