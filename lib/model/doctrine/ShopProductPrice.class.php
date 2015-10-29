<?php

/**
 * Class ShopProduct contains one product instance (product or domain)
 */
class ShopProductPrice
{
  protected $billingPeriod;
  protected $base;
  protected $type;
  protected $setup;
  protected $currencySuffix;

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
    $this->currencySuffix = $params['currencySuffix'];
  }

  public function __toString()
  {
    $stringRepresentation = sprintf('%1$s - %2$d', $this->billingPeriod, $this->base);
    $stringRepresentation .= ($this->setup)? sprintf(' (+%1$d)', $this->setup) : '';
    $stringRepresentation .= sprintf(' %1$s', $this->currencySuffix);
    return $stringRepresentation;
  }
}