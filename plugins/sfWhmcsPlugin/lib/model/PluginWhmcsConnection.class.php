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
   * @var array Connection config details
   */
  protected $connectionConfig = [];

  /**
   * @var array List of currencies
   */
  protected $currencies = false;

  /**
   * @var string Currencies class name
   */
  protected $currenciesClass = 'PluginWhmcsCurrencies';

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
    $this->connectionConfig = $config;

    // Override Currencies class name if one provided
    if(isset($params['currenciesClass']))
    {
      $this->currenciesClass = $params['currenciesClass'];
    }
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
      $this->currencies = new $this->currenciesClass([]);
    }

    if(!isset($currencies->currencies) || !isset($currencies->currencies->currency))
    {
      // TODO: Log error. Some error occurred. No currencies provided by WHMCS
      $this->currencies = new $this->currenciesClass([]);
      return false;
    }
    // Save currencies array in the current connection instance
    $this->currencies = new $this->currenciesClass($currencies->currencies->currency);
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
    if($apiResult->result != WHMCS_Base::SUCCESS)
    {
      // TODO: Log error. Request issues
      return false;
    }
    return $apiResult;
  }
}