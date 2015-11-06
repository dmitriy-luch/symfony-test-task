<?php

/**
 * Currencies list class.
 *
 * @package    shop
 * @subpackage whmcs
 * @author     Dmitriy
 */
class PluginWhmcsCurrencies implements Iterator
{
  /**
   * @var array List of currencies
   */
  protected $currencies = false;

  /**
   * Class constructor
   *
   * @param array $currencies An optional array of pre-defined currencies.
   *
   * @throws Exception When currencies are not an array
   */
  public function __construct($currencies)
  {
    // If provided currencies are not an array or not an object - throw exception
    if(!is_array($currencies) && !is_object($currencies))
    {
      throw new Exception('Currencies should be provided in an array or as an StdClass.');
    }
    // Currencies list is empty by default
    $this->currencies = [];
    foreach ($currencies as $currency)
    {
      // Save currencies indexed by their code
      $this->currencies[(string)$currency->code] = $currency;
    }
  }

  /**
   * Get all currencies
   *
   * @return array List of currencies
   */
  public function all()
  {
    return $this->currencies;
  }

  /**
   * List of currencies with their code as key and value
   */
  public function values()
  {
    return array_map(function($element){
      return $element->code;
    }, $this->currencies);
  }

  /**
   * Find currency by code.
   *
   * @param string $code Currency code
   * @return StdClass|null
   */
  public function findByCode($code)
  {
    return (isset($this->currencies[$code]))? $this->currencies[$code] : null;
  }

  public function findById($id)
  {
    foreach ($this->currencies as $currency)
    {
      if($currency->id == $id)
      {
        return $currency;
      }
    }

    return null;
  }

  /**
   * Return first currency from array or null if none found
   *
   * @return null|StdClass Currency item
   */
  public function getFirstCurrency()
  {
    return isset($this->currencies[0])? $this->currencies[0] : null;
  }


  // Iterator interface methods
  public function rewind()
  {
    reset($this->currencies);
  }

  public function current()
  {
    return current($this->currencies);
  }

  public function key()
  {
    return key($this->currencies);
  }

  public function next()
  {
    return next($this->currencies);
  }

  public function valid()
  {
    $key = key($this->currencies);
    return ($key !== NULL && $key !== FALSE);
  }
}