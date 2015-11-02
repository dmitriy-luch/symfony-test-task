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
    if($this->cart)
    {
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
  }

  public function executeAddToCart(sfWebRequest $request)
  {
    $params = $this->getFormParams();

    if($this->saveShopProduct($params))
    {
      if($request->isXmlHttpRequest()){
        // TODO: Reload Cart component
        return $this->renderComponent('ShopCart', 'cart');
      }
      // Redirect to cart with newly added product
      $this->redirect('cart');
    }
  }

  public function executeUpdateInCart(sfWebRequest $request)
  {
    $params = $this->getFormParams();
    $action = (isset($params['action']))? $params['action'] : null;

    switch($action){
      case 'Update':
        $this->saveShopProduct($params);
        $this->redirect('cart');
        break;
      case 'Remove':
        $cartProduct = $this->getCartProduct($params);
        $cartProduct->delete();
        $this->redirect('cart');
        break;
      default:
        $this->redirect('cart');
        break;
    }
  }

  protected function getFormParams($formClass = "CartProductForm")
  {
    return $this->getRequest()->getParameter($formClass::FORM_NAME);
  }

  protected function getCartProduct($params, $itemClass = "CartProduct")
  {
    $cartProduct = null;
    if(!empty($params['id']))
    {
      $cartProduct = Doctrine::getTable($itemClass)->findOneById($params['id']);
      $cartProduct->load($params);
    } else {
      $cartProduct = new $itemClass();
      $cartProduct->fromArray($params);
    }
    return $cartProduct;
  }

  protected function saveShopProduct($params, $itemClass = "CartProduct")
  {
    $cartProduct = $this->getCartProduct($params, $itemClass);
    $formClass = $itemClass . "Form";
    $this->productForm = new $formClass(
        $cartProduct,
        [
            'currency' => $this->getUser()->getCurrencyId(),
            'request' => $this->getRequest(),
            'response' => $this->getResponse(),
            'user' => $this->getUser(),
        ]
    );
    $this->productForm->bind($params);

    if($isValid = $this->productForm->isValid())
    {
      $this->productForm->save();
    }
    return $isValid;
  }
}
