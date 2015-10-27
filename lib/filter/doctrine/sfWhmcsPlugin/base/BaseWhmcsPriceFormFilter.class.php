<?php

/**
 * WhmcsPrice filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWhmcsPriceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'product' => 'product', 'addon' => 'addon', 'configoptions' => 'configoptions', 'domainregister' => 'domainregister', 'domaintransfer' => 'domaintransfer', 'domainrenew' => 'domainrenew', 'domainaddons' => 'domainaddons'))),
      'currency'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'relid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WhmcsDomainTld'), 'add_empty' => true)),
      'msetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'qsetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ssetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'asetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bsetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tsetupfee'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'monthly'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'quarterly'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'semiannually' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'annually'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'biennially'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'triennially'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'type'         => new sfValidatorChoice(array('required' => false, 'choices' => array('product' => 'product', 'addon' => 'addon', 'configoptions' => 'configoptions', 'domainregister' => 'domainregister', 'domaintransfer' => 'domaintransfer', 'domainrenew' => 'domainrenew', 'domainaddons' => 'domainaddons'))),
      'currency'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'relid'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WhmcsDomainTld'), 'column' => 'id')),
      'msetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qsetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ssetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'asetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'bsetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tsetupfee'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'monthly'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quarterly'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'semiannually' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'annually'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'biennially'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'triennially'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('whmcs_price_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsPrice';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'type'         => 'Enum',
      'currency'     => 'Number',
      'relid'        => 'ForeignKey',
      'msetupfee'    => 'Number',
      'qsetupfee'    => 'Number',
      'ssetupfee'    => 'Number',
      'asetupfee'    => 'Number',
      'bsetupfee'    => 'Number',
      'tsetupfee'    => 'Number',
      'monthly'      => 'Number',
      'quarterly'    => 'Number',
      'semiannually' => 'Number',
      'annually'     => 'Number',
      'biennially'   => 'Number',
      'triennially'  => 'Number',
    );
  }
}
