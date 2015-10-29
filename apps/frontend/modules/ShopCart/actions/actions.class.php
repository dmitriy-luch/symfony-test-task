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
        ]
    );
    $this->productForm->bind($params);
    if($this->productForm->isValid())
    {
      // TODO: Move to AddProduct method
      // Get current cart or create new
      $cartToken = $this->getUser()->getCart($request);
      if(!$cartToken){
        $cartToken = $this->getUser()->createCart($this->getResponse());
      }
      // TODO: Add to cart
      if($request->isXmlHttpRequest()){
        // TODO: Reload Cart component
        return $this->renderText('test');
      }
      // Redirect to cart with newly added product
      return $this->redirect('cart');
    }

    if($request->isXmlHttpRequest()){
      return $this->renderPartial('FrontendShopCategory/addToCartForm');
    }
  }
}
