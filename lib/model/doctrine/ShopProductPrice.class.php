<?php

/**
 * Class ShopProductPrice represents one billing period price for one product
 */
class ShopProductPrice
{
  protected $billingPeriod;
  protected $base;
  protected $type;
  protected $setup;
  protected $currencySuffix;
  protected $total;

  public function __construct($params)
  {
    if(
        !isset($params['base'])
        || !isset($params['billingPeriod'])
        || !isset($params['currencySuffix'])
        || !isset($params['type'])
    )
    {
      // TODO: Consider what to do next. Throw an exception probably
    }

    $this->billingPeriod = $params['billingPeriod'];
    $this->base = $params['base'];
    $this->type = $params['type'];
    $this->setup = (isset($params['setup']))? $params['setup'] : null;
    $this->total = $this->base + $this->setup;
    $this->currencySuffix = $params['currencySuffix'];
  }

  /**
   * Representation of price in format
   * "Billing Period ~ Price with Currency (Base price with Currency + Setup Price with Currency)"
   * When no setup price available the format is
   * "Billing Period ~ Price with Currency"
   *
   * @return string
   */
  public function __toString()
  {
    $stringRepresentation = sprintf('%1$s ~ %2$d %3$s', $this->billingPeriod, $this->total, $this->currencySuffix);
    if($this->setup)
    {
      $stringRepresentation .= sprintf(' (%1$d %2$s Base + %3$d %2$s Setup)', $this->base, $this->currencySuffix, $this->setup);
    }
    return $stringRepresentation;
  }

  /**
   * Getter for Base and Setup values total field
   *
   * @return double
   */
  public function getTotal()
  {
    return $this->total;
  }
}