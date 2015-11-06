<?php

/**
 * ShopCart form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopCartForm extends BaseShopCartForm
{
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
    unset($this['created_at'], $this['updated_at'], $this['client_id']);
    foreach($this->getObject()->getCartProducts() as $key => $cartProduct)
    {
      $this->embedRelation(
        'CartProducts',
        'CartProductForm',
        [
          [
            'request' => $this->options['request'],
            'response' => $this->options['response'],
            'user' => $this->options['user'],
            'action' => CartProductForm::ACTION_UPDATE,
          ]
        ]
      );
    }

    if(!$this->object->getClient())
    {
      // Fill customer widgets and validators only if customer is not yet created
      $this->fillClientWidgetsAndValidators();
    }

  }

  /**
   * Fill client widgets and validators based on  incoming option isExistingCustomer
   * Show only email field when true
   * Show all required fields when false
   */
  protected function fillClientWidgetsAndValidators()
  {
    if(!empty($this->options['isExistignCustomer']) && $this->options['isExistignCustomer'])
    {
      $this->fillExistingClientWidgets();
      $this->fillExistingCustomerValidators();
    }
    else
    {
      $this->fillNewClientWidgets();
      $this->fillNewClientValidators();
    }
  }

  /**
   * Fill New client fields widgets
   */
  protected function fillNewClientWidgets()
  {
    $this->setWidget('firstname', new sfWidgetFormInputText(['label' => 'First name']));
    $this->setWidget('lastname', new sfWidgetFormInputText(['label' => 'Last name']));
    $this->setWidget('email', new sfWidgetFormInputText(['label' => 'Email']));
    $this->setWidget('address1', new sfWidgetFormInputText(['label' => 'Address']));
    $this->setWidget('city', new sfWidgetFormInputText());
    $this->setWidget('state', new sfWidgetFormInputText());
    $this->setWidget('postcode', new sfWidgetFormInputText(['label' => 'Post code']));
    $this->setWidget('country', new sfWidgetFormI18nChoiceCountry(['label' => 'Country (2-letter code)']));
    $this->setWidget('phonenumber', new sfWidgetFormInputText(['label' => 'Phone number']));
    $this->setWidget('password2', new sfWidgetFormInputPassword(['label' => 'Password']));
  }

  /**
   * Fill New client fields validators
   */
  protected function fillNewClientValidators()
  {
    $this->setValidator('firstname', new sfValidatorString());
    $this->setValidator('lastname', new sfValidatorString());
    $this->setValidator(
        'email',
        new sfValidatorAnd(
            [
                new sfValidatorEmail(),
                new sfValidatorCallback(['callback' => [$this, 'validateNewClient']], ['invalid' => 'Such email is already registered']),
            ]
        )
    );
    $this->setValidator('address1', new sfValidatorString());
    $this->setValidator('city', new sfValidatorString());
    $this->setValidator('state', new sfValidatorString());
    $this->setValidator('postcode', new sfValidatorString());
    $this->setValidator('country', new sfValidatorI18nChoiceCountry());
    $this->setValidator('phonenumber', new sfValidatorString());
    $this->setValidator('password2', new sfValidatorString());
  }

  /**
   * Fill Existing client fields widgets
   */
  protected function fillExistingClientWidgets()
  {
    $this->setWidget('email', new sfWidgetFormInputText(['label' => 'Client Email']));
  }

  /**
   * Fill Existing client fields validators
   */
  protected function fillExistingCustomerValidators()
  {
    $this->setValidator(
      'email',
      new sfValidatorAnd(
        [
          new sfValidatorEmail(),
          new sfValidatorCallback(['callback' => [$this, 'validateExistingClient']], ['invalid' => 'Such email is not registered']),
        ]
      )
    );
  }

  /**
   * Existing client validator
   * Checks if client email is already registered and throws an error otherwise
   *
   * @param sfValidatorBase $validator
   * @param $value
   * @param array $arguments
   * @return mixed
   * @throws sfValidatorError
   */
  public function validateExistingClient(sfValidatorBase $validator, $value, array $arguments)
  {
    if(!$this->getClient($value))
    {
      throw new sfValidatorError($validator, 'invalid');
    }
    return $value;
  }

  /**
   * New client validator
   * Checks if client email is already registered and throws an error if yes
   *
   * @param sfValidatorBase $validator
   * @param $value
   * @param array $arguments
   * @return mixed
   * @throws sfValidatorError
   */
  public function validateNewClient(sfValidatorBase $validator, $value, array $arguments)
  {
    if($this->getClient($value))
    {
      throw new sfValidatorError($validator, 'invalid');
    }
    return $value;
  }

  /**
   * Get WHMCS Client by provided email via API
   * Return false when no Client is found
   *
   * @param $email
   * @return bool|SimpleXmlElement WHMCS Client or false when none found
   */
  protected function getClient($email)
  {
    $client = PluginWhmcsConnection::initConnection()->getClientByEmail($email);
    if(empty($client))
    {
      return false;
    }
    return $client;
  }

  /**
   * Fill in client id field in case it is not filled yet and proceed to saving
   * Get Client ID from WHMCS API by email or create new Client when not found
   *
   * @param null $con
   */
  protected function doSave($con = null)
  {
    if(!$this->getObject()->getClient())
    {
      // Proceed to filling client ID only if it is not set yet
      $client = $this->getClient($this->getValue('email'));
      if(!$client)
      {
        // Create new client when there is no one found by current email
        $client = $this->createClient($this->getValues());
      }
      // Save client id to object before saving it to DB
      $this->getObject()->setClientId($client->id);
    }
    parent::doSave($con);
  }

  /**
   * @return array Client fields list
   */
  protected static function getClientFields()
  {
    $clientFields = [
        'firstname',
        'lastname',
        'email',
        'address1',
        'city',
        'state',
        'postcode',
        'country',
        'phonenumber',
        'password2',
    ];
    return $clientFields;
  }

  /**
   * Create client based on values array
   *
   * @param $values
   * @return SimpleXmlElement WHMCS Client object
   */
  protected function createClient($values)
  {
    $params = [];
    foreach ($this->getClientFields() as $clientField)
    {
      if(!empty($values[$clientField]))
      {
        $params[$clientField] = $values[$clientField];
      }
    }
    $params['currency'] = $this->options['user']->getCurrencyId();
    return PluginWhmcsConnection::initConnection()->createClient($params);
  }
}
