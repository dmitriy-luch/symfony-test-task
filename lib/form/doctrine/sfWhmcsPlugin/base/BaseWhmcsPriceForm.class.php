<?php

/**
 * WhmcsPrice form base class.
 *
 * @method WhmcsPrice getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWhmcsPriceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'type'         => new sfWidgetFormChoice(array('choices' => array('product' => 'product', 'addon' => 'addon', 'configoptions' => 'configoptions', 'domainregister' => 'domainregister', 'domaintransfer' => 'domaintransfer', 'domainrenew' => 'domainrenew', 'domainaddons' => 'domainaddons'))),
      'currency'     => new sfWidgetFormInputText(),
      'relid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WhmcsDomainTld'), 'add_empty' => false)),
      'msetupfee'    => new sfWidgetFormInputText(),
      'qsetupfee'    => new sfWidgetFormInputText(),
      'ssetupfee'    => new sfWidgetFormInputText(),
      'asetupfee'    => new sfWidgetFormInputText(),
      'bsetupfee'    => new sfWidgetFormInputText(),
      'tsetupfee'    => new sfWidgetFormInputText(),
      'monthly'      => new sfWidgetFormInputText(),
      'quarterly'    => new sfWidgetFormInputText(),
      'semiannually' => new sfWidgetFormInputText(),
      'annually'     => new sfWidgetFormInputText(),
      'biennially'   => new sfWidgetFormInputText(),
      'triennially'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'         => new sfValidatorChoice(array('choices' => array(0 => 'product', 1 => 'addon', 2 => 'configoptions', 3 => 'domainregister', 4 => 'domaintransfer', 5 => 'domainrenew', 6 => 'domainaddons'))),
      'currency'     => new sfValidatorInteger(),
      'relid'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WhmcsDomainTld'))),
      'msetupfee'    => new sfValidatorNumber(),
      'qsetupfee'    => new sfValidatorNumber(),
      'ssetupfee'    => new sfValidatorNumber(),
      'asetupfee'    => new sfValidatorNumber(),
      'bsetupfee'    => new sfValidatorNumber(),
      'tsetupfee'    => new sfValidatorNumber(),
      'monthly'      => new sfValidatorNumber(),
      'quarterly'    => new sfValidatorNumber(),
      'semiannually' => new sfValidatorNumber(),
      'annually'     => new sfValidatorNumber(),
      'biennially'   => new sfValidatorNumber(),
      'triennially'  => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('whmcs_price[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsPrice';
  }

}
