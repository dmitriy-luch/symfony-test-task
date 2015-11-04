<?php

/**
 * WHMCS Connection class.
 *
 * @package    shop
 * @subpackage whmcs
 * @author     Dmitriy
 */
class PluginWhmcsConnection
{
  /**
   * @var PluginWhmcsConnection Instance of PluginWhmcsConnection connection class
   */
  protected static $_instance;

  /**
   * @var array Class config details
   */
  protected $config = [];

  /**
   * @var array List of currencies
   */
  protected $currencies = false;

  /**
   * @var array List of payment methods
   */
  protected $paymentMethods = false;

  /**
   * @var SimpleXmlElement Client object
   */
  protected $client = false;

  /**
   * Class constructor
   *
   * @param array $params An optional array of connection details.
   * If none provided - the ones from config or defaults will be used
   * Available options:
   *  username - The username to be used for connection
   *  password - The password for WHMCS authentication
   *  domain   - The domain where WHMCS is installed
   *  api_path - The relative path on WHMCS website
   *  currencies_class - Currencies list instance class
   *
   * @throws Exception When params are not an array
   */
  public function __construct($params = [])
  {
    // If provided params are not an array - throw exception
    if(!is_array($params))
    {
      throw new Exception('Parameters should be provided in an array.');
    }
    // Get connection params from config or use defaults
    $defaults = [
      'username' => sfConfig::get('app_whmcs_username', 'admin'),
      'password' => sfConfig::get('app_whmcs_password', 'admin'),
      'domain' => sfConfig::get('app_whmcs_domain', 'localhost'),
      'api_path' => sfConfig::get('app_whmcs_api_path', 'includes/api.php'),
      'currencies_class' => sfConfig::get('app_whmcs_currencies_class', 'PluginWhmcsCurrencies'),
    ];
    // Override connection params with the provided ones
    $config = array_merge(
      $defaults,
      $params
    );

    // Set constants required by the WHMCS helpers.
    $url = $config['domain'] . "/" . $config['api_path'];
    define('WHMCS_URL', $url);
    define('WHMCS_USERNAME', $config['username']);
    // Password is provided as the md5 hash
    define('WHMCS_PASSWORD', md5($config['password'])); // md5 hash
    $this->config = $config;
  }

  /**
   * Overrode clone required by Singleton pattern
   * @return bool
   */
  public function __clone()
  {
    return false;
  }

  /**
   * Overrode clone required by Singleton pattern
   * @return bool
   */
  public function __wakeup()
  {
    return false;
  }

  /**
   * @param array $params An optional array of params for the connection constructor
   * @return PluginWhmcsConnection An instance of connection class
   */
  public static function initConnection($params = [])
  {
    // Create new instance if none exists or new params are provided
    if (self::$_instance === null || (is_array($params) && count($params) > 0))
    {
      self::$_instance = new self($params);
    }
    return self::$_instance;
  }

  /**
   * Get all currencies from WHMCS system
   *
   * @param bool $reload Whether to reload currencies from WHMCS or not. Defaults to False
   *
   * @return array List of currencies from WHMCS or an empty array in case of error or if none found;
   */
  public function getCurrencies($reload = false)
  {
    if ($reload || !$this->currencies)
    {
      $this->loadCurrencies();
    }
    return $this->currencies;
  }

  /**
   * Load list of WHMCS currencies and save into the object
   *
   * @return bool Whether the load was successful or not
   */
  protected function loadCurrencies()
  {
    $currencies = $this->apiCall('WHMCS_Misc', 'get_currencies');
    if (!$currencies)
    {
      $this->currencies = new $this->config['currencies_class']([]);
    }

    if(!isset($currencies->currencies) || !isset($currencies->currencies->currency))
    {
      // TODO: Log error. Some error occurred. No currencies provided by WHMCS
      $this->currencies = new $this->config['currencies_class']([]);
      return false;
    }
    // Save currencies array in the current connection instance
    $this->currencies = new $this->config['currencies_class']($currencies->currencies->currency);
    return true;
  }

  /**
   * Get all payment methods from WHMCS system
   *
   * @param bool $reload Whether to reload payment methods from WHMCS or not. Defaults to False
   *
   * @return array List of payment methods from WHMCS or an empty array in case of error or if none found;
   */
  public function getPaymentMethods($reload = false)
  {
    if ($reload || !$this->paymentMethods)
    {
      $this->loadPaymentMethods();
    }
    return $this->paymentMethods;
  }

  /**
   * Load list of WHMCS payment methods and save into the object
   *
   * @return bool Whether the load was successful or not
   */
  protected function loadPaymentMethods()
  {
    $this->paymentMethods = [];
    $paymentMethodsResult = $this->apiCall('WHMCS_Invoice', 'get_payment_methods');
    if (empty($paymentMethodsResult) || empty($paymentMethodsResult->paymentmethods) || empty($paymentMethodsResult->paymentmethods->paymentmethod))
    {
      // TODO: Log error. Some error occurred. No payment methods provided by WHMCS
      return false;
    }

    foreach ($paymentMethodsResult->paymentmethods->paymentmethod as $paymentMethod)
    {
      $this->paymentMethods[(string)$paymentMethod->module] = (string)$paymentMethod->displayname;
    }
    return true;
  }

  /**
   * @param string $class Class name to run api call in
   * @param string $method Class method to run api call
   * @param array $params An optional array of params to send to api call method
   * @return bool|mixed Api call result or false in case of error
   */
  protected function apiCall($class, $method, $params = [])
  {
    $apiResult = call_user_func([$class, $method], $params);
    if(empty($apiResult->result) || $apiResult->result != WHMCS_Base::SUCCESS)
    {
      // TODO: Log error. Request issues
      return false;
    }
    return $apiResult;
  }

  /**
   * Get client by email from WHMCS system
   *
   * @param string $email Customer email
   * @param bool $reload Whether to reload client from WHMCS or not. Defaults to False
   *
   * @return SimpleXmlElement Customer from WHMCS or false in case of error or if none found;
   */
  public function getClientByEmail($email, $reload = false)
  {
    if ($reload || empty($this->client) || $this->client->email != $email)
    {
      $this->loadClient(['email' => $email]);
    }
    return $this->client;
  }

  /**
   * Get client by ID from WHMCS system
   *
   * @param int $clientId Customer ID
   * @param bool $reload Whether to reload client from WHMCS or not. Defaults to False
   *
   * @return SimpleXmlElement Customer from WHMCS or false in case of error or if none found;
   */
  public function getClientById($clientId, $reload = false)
  {
    if ($reload || empty($this->client) || $this->client->id != $clientId)
    {
      $this->loadClient(['clientid' => $clientId]);
    }
    return $this->client;
  }

  /**
   * Load client from WHMCS system by the provided params
   * @param $params
   */
  protected function loadClient($params)
  {
    $this->client = null;
    $result = $this->apiCall('WHMCS_Client', 'get_clients_details', $params);
    if(!empty($result))
    {
      $this->client = $result;
    }
  }

  /**
   * Create client in WHMCS system by provided params
   *
   * @param $params
   * @return SimpleXmlElement WHMCS Client
   */
  public function createClient($params)
  {
    if(!$this->getClientByEmail($params['email']))
    {
      $result = $this->apiCall('WHMCS_Client', 'add_client', $params);
      if(!empty($result))
      {
        return $this->getClientById($result->clientid);
      }
    }
    return $this->client;
  }

  /**
   * Create new order based on provided params
   *
   * @param $params
   * @return bool|SimpleXmlElement Newly created order or false in case of error
   */
  public function createOrder($params)
  {
    $result = $this->apiCall('WHMCS_Order', 'add_order', $params);
    if(!empty($result) && !empty($result->orderid))
    {
      return $result;
    }
    return false;
  }

  /**
   * Additional fields keys for Server product type
   *
   * @return array
   */
  public static function getServerAdditionalFields()
  {
    return [
      'hostname',
      'ns1prefix',
      'ns2prefix',
      'rootpw'
    ];
  }

  /**
   * Additional fields keys for Domain
   *
   * @return array
   */
  public static function getDomainAdditionalFields()
  {
    return [
      'domain',
      'dnsmanagement',
      'emailforwarding',
      'idprotection',
      'nameserver2',
      'nameserver3',
      'nameserver4',
      'contactid' => self::getContactFields(),
    ];
  }

  /**
   * Additional fields keys for Contact
   *
   * @return array
   */
  public static function getContactFields()
  {
    return [
        'firstname',
        'lastname',
        'companyname',
        'email',
        'address1',
        'address2',
        'city',
        'state',
        'postcode',
        'country',
        'phonenumber',
        'generalemails',
        'productemails',
        'domainemails',
        'invoiceemails',
        'supportemails',
    ];
  }

  /**
   * Create contact in WHMCS system by provided params
   *
   * @param $params
   * @return SimpleXmlElement WHMCS Client ID
   */
  public function createContact($params)
  {
    $result = $this->apiCall('WHMCS_Client', 'add_contact', $params);
    if(!empty($result))
    {
      return $result->contactid;
    }
    return null;
  }

  public function isDomainAvailable($domain)
  {
    $result = $this->apiCall('WHMCS_Misc', 'domain_whois', ['domain' => $domain]);
    return (!empty($result) && $result->status == 'available');
  }
}