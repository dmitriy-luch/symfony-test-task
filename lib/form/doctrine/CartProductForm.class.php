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

  protected $internalParams;

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
    unset($this['params']);
    // Get product type from the CartProduct item
    $type = $this->getObject()->getType();
    // Get WHMCS Product ID from the CartProduct item
    $whmcsId = $this->getObject()->getWhmcsPid();

    // Add hidden fields with related category, whmcs product id, whmcs type, and cart
    $this->setWidget('category_id', new sfWidgetFormInputHidden());
    $this->setWidget('whmcs_pid', new sfWidgetFormInputHidden());
    $this->setWidget('cart_id', new sfWidgetFormInputHidden());
    $this->setWidget('type', new sfWidgetFormInputHidden());

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
      $billingPeriods = $shopProduct->getPrices($this->options['user']->getCurrencyId());
    }
    // Create Period widget from Billing Periods list. __toString from each ShopProductPrice is used here.
    $this->setWidget('period', new sfWidgetFormChoice(['choices' => $billingPeriods]));

    // Disable field for Removal form
    if(isset($this->options['action']) && $this->options['action'] == self::ACTION_REMOVE)
    {
      $this->widgetSchema['period']->setAttribute('disabled', 'disabled');
    }

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
        'action'=> new sfValidatorChoice(
          [
            'required' => true,
            'choices' => $this->actionsList()
          ]
        ),
      ]
    );

    // Add additional fields for non-Add forms only
    if(empty($this->options['action']) || !in_array($this->options['action'], [self::ACTION_ADD, self::ACTION_REMOVE]))
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
          $this->mergePostValidator(new sfValidatorCallback(
              [
                'callback' => [$this, 'cleanProductAdditionalFields'],
              ],
              [
                'invalid' => 'Additional fields values invalid.'
              ]
            )
          );
          $this->parseAdditionalFields();
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
    $currentPassword = $this->getObject()->getParamValue('rootpw');
    $this->setValidator('rootpw', new sfValidatorString(['required' => !$currentPassword]));
  }

  /**
   * Add domain-related fields to the form
   */
  protected function fillDomainWidgetsAndValidators()
  {
    $this->fillDomainWidgets();
    $this->fillDomainValidators();
    $this->parseAdditionalFields();
    $this->mergePostValidator(new sfValidatorCallback(
            [
                'callback' => [$this, 'cleanProductAdditionalFields'],
            ],
            [
                'invalid' => 'Additional fields values invalid.'
            ]
        )
    );
  }

  /**
   * Add domain-related widgets
   */
  protected function fillDomainWidgets()
  {
    $this->setWidget('domain', new sfWidgetFormInputText(['label' => 'Domain name']));

    $this->setWidget('dnsmanagement', new sfWidgetFormInputCheckbox(['label' => 'Enable DNS Management']));
    $this->setWidget('emailforwarding', new sfWidgetFormInputCheckbox(['label' => 'Enable Email Forwarding']));
    $this->setWidget('idprotection', new sfWidgetFormInputCheckbox(['label' => 'Enable ID Protection']));
    $this->setWidget('nameserver2', new sfWidgetFormInputText(['label' => 'Nameserver 2']));
    $this->setWidget('nameserver3', new sfWidgetFormInputText(['label' => 'Nameserver 3']));
    $this->setWidget('nameserver4', new sfWidgetFormInputText(['label' => 'Nameserver 4']));
    if(!$this->getObject()->getParamValue('contactid'))
    {
      // Show contact fields only if contact is not created yet
      $this->fillContactWidgets();
    }
  }

  /**
   * Add domain-related validators
   */
  protected function fillDomainValidators()
  {
    $this->setValidator(
      'domain',
      new sfValidatorCallback(
          [
              'callback' => [
                $this,
                'domainWhoisValidator'
              ],
          ],
          ['invalid' => 'Domain name is not available']
      )
    );

    $this->setValidator('dnsmanagement', new sfValidatorBoolean());
    $this->setValidator('emailforwarding', new sfValidatorBoolean());
    $this->setValidator('idprotection', new sfValidatorBoolean());
    $this->setValidator('nameserver2', new sfValidatorString());
    $this->setValidator('nameserver3', new sfValidatorString());
    $this->setValidator('nameserver4', new sfValidatorString());
    if(!$this->getObject()->getParamValue('contactid'))
    {
      $this->fillContactValidators();
    }
  }

  /**
   * Add Domain-contact specific field validators
   */
  protected function fillContactValidators(){
    $this->setValidator('firstname', new sfValidatorString());
    $this->setValidator('lastname', new sfValidatorString());
    $this->setValidator('companyname', new sfValidatorString());
    $this->setValidator('email', new sfValidatorEmail());
    $this->setValidator('address1', new sfValidatorString());
    $this->setValidator('address2', new sfValidatorString());
    $this->setValidator('city', new sfValidatorString());
    $this->setValidator('state', new sfValidatorString());
    $this->setValidator('postcode', new sfValidatorString());
    $this->setValidator('country', new sfValidatorI18nChoiceCountry());
    $this->setValidator('phonenumber', new sfValidatorString());
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
    $this->setWidget('country', new sfWidgetFormI18nChoiceCountry(['label' => 'Country (2-letter code)']));
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

  /**
   * Post validator callback
   * Clean product additional fields in provided values
   *
   * @param sfValidatorBase $validator
   * @param array $values
   * @param array $arguments
   * @return array
   */
  public function cleanProductAdditionalFields(sfValidatorBase $validator, array $values, array $arguments)
  {
    $values = $this->combineAdditionalFields(
      $this->getObject()->getAdditionalFieldKeys(),
      $values
    );
    return $values;
  }

  /**
   * Combine all the provided fields with the default ones and save into params field
   *
   * @param $fieldsList array Field names list to combine
   * @param $values array Values list from post-validator
   * @return array Updated values list
   */
  protected function combineAdditionalFields($fieldsList, $values)
  {
    $values['params'] = json_encode($this->generateParamsAndUnsetValues($fieldsList, $values));
    return $values;
  }

  /**
   * Generate params for each of provided fields (with nesting) and unset them from values array
   *
   * @param $fieldsList
   * @param $values
   * @return array
   */
  protected function generateParamsAndUnsetValues($fieldsList, &$values)
  {
    $result = [];
    foreach ($fieldsList as $key => $field)
    {
      // Separate logic for sub-entities
      if(is_array($field))
      {
        // Fill in default value based on array key
        $result[$key] = $this->getObject()->getParamValue($key);

        $subResult = $this->generateSubEntitiesParamsAndUnsetValues($field, $values, $key);
        if(!empty($subResult))
        {
          // Save new result in case it not empty
          $result[$key] = $subResult;
        }
        // Proceed to the next field
        continue;
      }

      // Fill in default value
      $result[$field] = $this->getObject()->getParamValue($field);

      if(!empty($values[$field]))
      {
        // Override default value in case new one is provided
        $result[$field] = $values[$field];
        // Unset from values array so that it won't be used for Update
        unset($values[$field]);
      }
    }
    return $result;
  }

  /**
   * Generate params for provided sub entity and unset used params from values
   *
   * @param $fields
   * @param $values
   * @param $key
   * @return null|SimpleXmlElement
   */
  protected function generateSubEntitiesParamsAndUnsetValues($fields, &$values, $key)
  {
    $result = null;
    switch($key)
    {
      // TODO: Add contact constant
      case 'contactid':
        if(!$this->getObject()->getParamValue('contactid'))
        {
          $result = $this->createContact($values, $fields);
          $values = $this->unsetContactFields($values);
        }
        break;
    }
    return $result;
  }


  /**
   * Parse additional field provided in Params and set default values for each of them
   */
  protected function parseAdditionalFields()
  {
    foreach($this->getObject()->getDecodedParams() as $field => $value)
    {
      $this->setDefault($field, $value);
    }
  }

  /**
   * Unset contact fields from provided array
   *
   * @param $values
   */
  protected function unsetContactFields($values)
  {
    foreach (PluginWhmcsConnection::getContactFields() as $contactField)
    {
      if(isset($values[$contactField]))
      {
        unset($values[$contactField]);
      }
    }
    return $values;
  }

  /**
   * Create WHMCS contact based on provided values and field keys
   *
   * @param $values
   * @param $fields
   * @return SimpleXmlElement
   */
  protected function createContact($values, $fields)
  {
    $params = [];
    foreach ($fields as $contactField)
    {
      if(!empty($values[$contactField]))
      {
        $params[$contactField] = $values[$contactField];
      }
    }
    // Fill in required client ID parameter from current cart.
    $params['clientid'] = $this->options['user']->getCart()->getClientId();
    // TODO: Bug exists. Client Id might be null. Logic might need to be moved to create order method
    return PluginWhmcsConnection::initConnection()->createContact($params);
  }

  /**
   * Domain name WHOIS validator. Adds invalid error in case domain name is not available
   *
   * @param $validator
   * @param $value
   * @return mixed
   * @throws sfValidatorError
   */
  public function domainWhoisValidator($validator, $value)
  {
    $domain = $value;

    // Add TLD to domain name value
    // TODO: Make it DRY. Logic might need to be moved to CartProduct or ShopProduct class
    $tld = $this->getObject()->getShopProduct()->name;
    $domain .= $tld;

    // Check availability via WHMCS API
    $isAvailable = PluginWhmcsConnection::initConnection()->isDomainAvailable($domain);
    if ($isAvailable ) {
      return $value;
    } else {
      $validator->setMessage('invalid', sprintf('Domain name %s is not available', $domain));
      throw new sfValidatorError($validator, 'invalid');
    }
  }
}
