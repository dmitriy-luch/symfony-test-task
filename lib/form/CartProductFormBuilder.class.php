<?php

class CartProductFormBuilder
{
  /**
   * @var string CartProduct model class name
   */
  protected $modelClass;
  /**
   * @var string CartProductForm form class name
   */
  protected $formClass;
  /**
   * @var sfUser Current user to be used to get cart, currency, etc.
   */
  protected $user;
  /**
   * @var sfResponse Current response object to determine cookies, etc.
   */
  protected $response;
  /**
   * @var sfRequest Current request object to get request params, etc.
   */
  protected $request;
  /**
   * @var array Form Options.
   * An array of options to be merged with default ones and passed to Form constructor
   */
  protected $formOptions;
  /**
   * @var null|array Request params parsed from Request object by Form name index
   */
  protected $requestParams;

  public function __construct($params)
  {
    if(empty($params['user']) || empty($params['response']) || empty($params['request']))
    {
      throw new Exception('user, response and request are required.');
    }
    $this->requestParams = null;
    $this->user = $params['user'];
    $this->response = $params['response'];
    $this->request = $params['request'];
    // In case no Model Class is provided use "CartProduct"
    $this->modelClass = (isset($params['modelClass']))? $params['modelClass'] : 'CartProduct';
    // In case no Form Class is provided just append "Form" to the model class
    $this->formClass = (isset($params['formClass']))? $params['formClass'] : $this->modelClass . 'Form';
    $this->formOptions = (isset($params['formOptions']))? $params['formOptions'] : [];
  }

  /**

   * Get list of ShopProducts from provided cart and build forms for each of them
   *
   * @param $cart ShopCart Current user cart
   * @return array List of Cart Products with newly built form for each of them
   * @throws Exception When provided cart does not exist
   */
  public function buildFromCart($cart)
  {
    if(!$cart)
    {
      throw new Exception('Provided user cart is invalid');
    }
    $products = [];
    foreach($cart->getCartProducts() as $cartProduct)
    {
      // Build form for each of cart products
      $products[] = $this->createFormByCartProduct($cartProduct);
    }
    return $products;
  }

  /**
   * Add form to current Cart Product
   *
   * @param $cartProduct CartProduct item
   * @return mixed Cart Product item with appended form
   */
  public function createFormByCartProduct($cartProduct)
  {
    $form = $this->createForm($cartProduct);
    $product = $cartProduct->getShopProduct();
    $product->form = $form;
    return $product;
  }

  /**
   * Get list of ShopProducts for the provided category and build forms for each of them
   *
   * @param $category ShopCategory Category
   * @return array List of Cart Products with newly built form for each of them
   * @throws Exception When provided category does not exist
   */
  public function buildFromCategory($category)
  {
    if(!$category)
    {
      throw new Exception('Provided category is invalid');
    }
    $shopProducts = $category->getProducts();
    $products = [];
    foreach($shopProducts as $shopProduct)
    {
      // Build form for each of category products
      $products[] = $this->createFormByShopProduct($shopProduct, $category->getId());
    }
    return $products;
  }

  /**
   * Build CartProduct item with form by the provided ShopProduct
   *
   * @param $shopProduct ShopProduct item
   * @param $categoryId Category ID
   * @return mixed Cart Product item with appended form
   */
  public function createFormByShopProduct($shopProduct, $categoryId)
  {
    $cartProduct = $this->createCartProductByParams(
      [
        'category_id' => $categoryId,
        'whmcs_pid' => $shopProduct->id,
        'type' => $shopProduct->type,
      ]
    );
    return $this->createFormByCartProduct($cartProduct);
  }

  /**
   * @return mixed Shop Product item with appended form
   */
  public function buildOneFromParams()
  {
    $shopProduct = $this->createFormByParams();
    $shopProduct->form->bind($this->getParams());
    return $shopProduct;
  }

  /**
   * Return internal parameters list or load them from request first
   *
   * @return array Array of parameters for current form
   */
  protected function getParams()
  {
    if(!$this->requestParams)
    {
      $this->requestParams = $this->request->getParameter(constant($this->formClass . '::FORM_NAME'));
      if(!$this->requestParams)
      {
        $this->requestParams = [];
      }
    }
    return $this->requestParams;
  }

  /**
   * Create ShopProduct with appended form by the request parameters
   * @return mixed Shop Product
   */
  public function createFormByParams()
  {
    $cartProduct = null;
    if(!empty($this->getParams()['id']))
    {
      $cartProduct = $this->loadCartProductById($this->getParams()['id']);
    }
    else
    {
      $cartProduct = $this->createCartProductByParams($this->getParams());
    }
    return $this->createFormByCartProduct($cartProduct);
  }

  /**
   * Create new CartProduct item and load provided params into it
   *
   * @param $params
   * @return mixed CartProduct
   */
  protected function createCartProductByParams($params)
  {
    $cartProduct = new $this->modelClass();
    $cartProduct->fromArray($params);
    return $cartProduct;
  }

  /**
   * Get CartProduct from DB by ID and load request parameters
   *
   * @param $id
   * @return mixed CartProduct
   */
  protected function loadCartProductById($id)
  {
    $cartProduct = Doctrine::getTable($this->modelClass)->findOneById($id);
    if(!$cartProduct)
    {
      // If none found - use create method
      $cartProduct = $this->createCartProductByParams($this->getParams());
    }
    $cartProduct->load($this->getParams());
    return $cartProduct;
  }

  /**
   * Build CartProductForm form based on provided CartProduct item
   *
   * @param $productItem
   * @return mixed CartProductForm
   */
  protected function createForm($productItem)
  {
    return new $this->formClass(
        $productItem,
        array_merge(
          [
              'currency' => $this->user->getCurrencyId(),
              'request' => $this->request,
              'response' => $this->response,
              'user' => $this->user,
          ],
          $this->formOptions
        )
    );
  }

  /**
   * Create self instance and return in to use in nesting
   *
   * @param $params
   * @return CartProductFormBuilder
   */
  public static function init($params)
  {
    $formBuilderItem = new self($params);
    return $formBuilderItem;
  }
}