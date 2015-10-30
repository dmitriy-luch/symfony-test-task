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
    $this->cart = $this->getUser()->getCart($request);
    $this->products = [];
    foreach($this->cart->getCartProducts() as $cartProduct)
    {
      $form = new CartProductForm(
          $cartProduct,
          [
              'currency' => $this->getUser()->getCurrencyId(),
          ]
      );
      $product = $cartProduct->getShopProduct();
      $product->form = $form;
      $this->products[] = $product;
    }
  }

  public function executeAddToCart(sfWebRequest $request)
  {
    // Temporary hack
    // TODO: Refactoring required
    $this->productForm = new CartProductForm();
    $params = $request->getParameter($this->productForm->getName());

    $cartProduct = new CartProduct();
    $cartProduct->fromArray($params);
    $this->productForm = new CartProductForm(
        $cartProduct,
        [
          'currency' => $this->getUser()->getCurrencyId(),
          'request' => $request,
          'response' => $this->getResponse(),
          'user' => $this->getUser(),
        ]
    );
    $this->productForm->bind($params);
    if($this->productForm->isValid())
    {
      $this->productForm->save();
      if($request->isXmlHttpRequest()){
        // TODO: Reload Cart component
        return $this->renderText('test');
      }
      // Redirect to cart with newly added product
      return $this->redirect('cart');
    }
  }
}
