<?php

/**
 * CartProduct form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CartProductForm extends BaseCartProductForm
{
  protected $user;
  const ACTION_ADD = 'Add';
  const ACTION_UPDATE = 'Update';
  const ACTION_REMOVE = 'Remove';

  /**
   * List of available actions
   *
   * @return array
   */
  public static function actionsList()
  {
    return [
      self::ACTION_ADD,
      self::ACTION_UPDATE,
      self::ACTION_REMOVE,
    ];
  }

  const FORM_NAME = 'cart_product';

  public function __construct($object = null, $options = array(), $CSRFSecret = null)
  {
    if(empty($options['user']) || empty($options['request']) || empty($options['response']))
    {
      // User, Request and Response are required to build product form
      throw new Exception('user, request and response are required');
    }

    parent::__construct($object, $options, $CSRFSecret);
  }
  public function configure()
  {
    // Get product type from the CartProduct item
    $type = $this->getObject()->getType();
    // Get WHMCS Product ID from the CartProduct item
    $whmcsId = $this->getObject()->getWhmcsPid();

    // Add hidden fields with related category, whmcs product id, whmcs type, and cart
    $this->setWidget('category_id', new sfWidgetFormInputHidden());
    $this->setWidget('whmcs_pid', new sfWidgetFormInputHidden());
    $this->setWidget('cart_id', new sfWidgetFormInputHidden());
    $this->setWidget('type', new sfWidgetFormInputHidden());
    // Not used yet. Implemented for further usage.
    $this->setWidget('params', new sfWidgetFormInputHidden());

    // Add hidden action field in case a value is provided via options
    if(isset($this->options['action']))
    {
      $this->setWidget('action', new sfWidgetFormInputHidden());
      $this->setDefault('action', $this->options['action']);
    }

    // Get Shop Product from current Cart Product by its type and id
    $shopProduct = $this->getObject()->getShopProduct();

    // Fill in billing periods from Shop product in case it exists
    $billingPeriods = [];
    if($shopProduct)
    {
      $billingPeriods = $shopProduct->getPrices($this->options['currency']);
    }
    // Create Period widget from Billing Periods list. __toString from each ShopProductPrice is used here.
    $this->setWidget('period', new sfWidgetFormChoice(['choices' => $billingPeriods]));

    // Override default validators
    $this->setValidators(
      [
        'id' => new sfValidatorChoice(
          [
            'choices' => [$this->getObject()->get('id')],
            'empty_value' => $this->getObject()->get('id'),
            'required' => false
          ]
        ),
        'category_id' => new sfValidatorInteger(),
        'cart_id' => new sfValidatorInteger(
          [
            'required' => false
          ]
        ),
        'whmcs_pid'=> new sfValidatorInteger(),
        'type'=> new sfValidatorString(
          [
            'required' => true
          ]
        ),
        'period'=> new sfValidatorChoice(
          [
            'required' => true,
            'choices' => array_keys($billingPeriods)
          ]
        ),
        'params'=> new sfValidatorString(
          [
            'required' => false
          ]
        ),
        'action'=> new sfValidatorChoice(
          [
            'required' => true,
            'choices' => $this->actionsList()
          ]
        ),
      ]
    );

    // Add additional fields for non-Add forms only
    if(empty($this->options['action']) || $this->options['action'] != self::ACTION_ADD)
    {
      switch($type)
      {
        case ShopProduct::TYPE_DOMAIN:
          $this->fillDomainWidgetsAndValidators();
          break;
        case ShopProduct::TYPE_PRODUCT:
          $this->fillProductWidgetsAndValidators();
          break;
      }
    }

    $this->widgetSchema->setNameFormat(self::FORM_NAME . '[%s]');
  }

  /**
   * Add Product-related fields to the form
   */
  protected function fillProductWidgetsAndValidators()
  {
    // Get current CartProduct
    $cartProduct = $this->getObject();
    if($cartProduct && $shopProduct = $cartProduct->getShopProduct())
    {
      switch($shopProduct->productType)
      {
        case ShopProduct::PRODUCT_TYPE_SERVER:
          // Add VPS/Dedicated Server fields in case current ShopProduct type is server
          $this->fillServerWidgetsAndValidators();
          break;
      }
    }
  }

  /**
   * Add fields related to Product with type server
   */
  protected function fillServerWidgetsAndValidators()
  {
    $this->fillServerWidgets();
    $this->fillServerValidators();
  }

  /**
   * Add widgets for fields related to Product with type server
   */
  protected function fillServerWidgets()
  {
    $this->setWidget('hostname', new sfWidgetFormInputText());
    $this->setWidget('ns1prefix', new sfWidgetFormInputText(['label' => 'NS1 Prefix']));
    $this->setWidget('ns2prefix', new sfWidgetFormInputText(['label' => 'NS2 Prefix']));
    $this->setWidget('rootpw', new sfWidgetFormInputPassword(['label' => 'Root Password']));
  }

  /**
   * Add Validators for fields related to Product with type server
   */
  protected function fillServerValidators()
  {
    // TODO: Add RegEx validator for hostname
    $this->setValidator('hostname', new sfValidatorString(['required' => true]));
    $this->setValidator('ns1prefix', new sfValidatorString(['required' => true]));
    $this->setValidator('ns2prefix', new sfValidatorString(['required' => true]));
    $this->setValidator('rootpw', new sfValidatorString(['required' => true]));
  }

  /**
   * Add domain-related fields to the form
   */
  protected function fillDomainWidgetsAndValidators()
  {
    $this->fillDomainWidgets();
    $this->fillDomainValidators();
  }

  /**
   * Add domain-related widgets
   */
  protected function fillDomainWidgets()
  {
    // A hidden input might be required in case contact is already created
    //contactid - the ID of a contact to use for the domain registrant details

    // Domain fields might be required for order creation. A hidden validator might be needed here.
    //domainfields - a base64 encoded serialized array of the TLD specific field values

    $this->setWidget('dnsmanagement', new sfWidgetFormInputCheckbox(['label' => 'Enable DNS Management']));
    $this->setWidget('emailforwarding', new sfWidgetFormInputCheckbox(['label' => 'Enable Email Forwarding']));
    $this->setWidget('idprotection', new sfWidgetFormInputCheckbox(['label' => 'Enable ID Protection']));
    $this->setWidget('nameserver2', new sfWidgetFormInputText(['label' => 'Nameserver 2']));
    $this->setWidget('nameserver3', new sfWidgetFormInputText(['label' => 'Nameserver 3']));
    $this->setWidget('nameserver4', new sfWidgetFormInputText(['label' => 'Nameserver 4']));
    $this->fillContactWidgets();
  }

  /**
   * Add domain-related validators
   */
  protected function fillDomainValidators()
  {
    // Required Post validator might be needed here
    //contactid - the ID of a contact to use for the domain registrant details

    // In case domain field are required for order creation a required validator is needed here
    //domainfields - a base64 encoded serialized array of the TLD specific field values

    $this->setValidator('dnsmanagement', new sfValidatorBoolean());
    $this->setValidator('emailforwarding', new sfValidatorBoolean());
    $this->setValidator('idprotection', new sfValidatorBoolean());
    $this->setValidator('nameserver2', new sfValidatorString());
    $this->setValidator('nameserver3', new sfValidatorString());
    $this->setValidator('nameserver4', new sfValidatorString());
    $this->fillContactValidators();
  }

  /**
   * Add Domain-contact specific field validators
   */
  protected function fillContactValidators(){
    $this->setValidator('firstname', new sfValidatorString());
    $this->setValidator('lastname', new sfValidatorString());
    $this->setValidator('companyname', new sfValidatorString());
    $this->setValidator('email', new sfValidatorEmail());
    $this->setValidator('address1', new sfValidatorEmail());
    $this->setValidator('address2', new sfValidatorEmail());
    $this->setValidator('city', new sfValidatorEmail());
    $this->setValidator('state', new sfValidatorEmail());
    $this->setValidator('country', new sfValidatorEmail());
    $this->setValidator('phonenumber', new sfValidatorEmail());
    $this->setValidator('generalemails', new sfValidatorBoolean());
    $this->setValidator('productemails', new sfValidatorBoolean());
    $this->setValidator('domainemails', new sfValidatorBoolean());
    $this->setValidator('invoiceemails', new sfValidatorBoolean());
    $this->setValidator('supportemails', new sfValidatorBoolean());
  }

  /**
   * Add Domain-contact specific field widgets
   */
  protected function fillContactWidgets(){
    $this->setWidget('firstname', new sfWidgetFormInputText(['label' => 'First Name']));
    $this->setWidget('lastname', new sfWidgetFormInputText(['label' => 'Last Name']));
    $this->setWidget('companyname', new sfWidgetFormInputText(['label' => 'Company Name']));
    $this->setWidget('email', new sfWidgetFormInputText());
    $this->setWidget('address1', new sfWidgetFormInputText(['label' => 'Address 1']));
    $this->setWidget('address2', new sfWidgetFormInputText(['label' => 'Address 2']));
    $this->setWidget('city', new sfWidgetFormInputText());
    $this->setWidget('state', new sfWidgetFormInputText());
    $this->setWidget('postcode', new sfWidgetFormInputText(['label' => 'Post Code']));
    $this->setWidget('country', new sfWidgetFormInputText());
    $this->setWidget('phonenumber', new sfWidgetFormInputText(['label' => 'Phone number']));
    $this->setWidget('generalemails', new sfWidgetFormInputCheckbox(['label' => 'Receive general emails']));
    $this->setWidget('productemails', new sfWidgetFormInputCheckbox(['label' => 'Receive product related emails']));
    $this->setWidget('domainemails', new sfWidgetFormInputCheckbox(['label' => 'Receive domain related emails']));
    $this->setWidget('invoiceemails', new sfWidgetFormInputCheckbox(['label' => 'Receive billing related emails']));
    $this->setWidget('supportemails', new sfWidgetFormInputCheckbox(['label' => 'Receive support ticket related emails']));
  }

  /**
   * Custom cart id field update method.
   * Cart id is set to current User cart or new cart is created
   *
   * @param $value
   * @return mixed
   */
  public function updateCartIdColumn($value)
  {
    if($value)
    {
      return $value;
    }
    // Get current user cart or create new
    $cart = $this->getOption('user')
        ->getCartOrCreate(
          [
            'request' => $this->getOption('request'),
            'response' => $this->getOption('response'),
          ]
        );
    if(!$cart){
      // TODO: Add error to form if possible or throw an exception
    }
    return $cart->getId();
  }
}
