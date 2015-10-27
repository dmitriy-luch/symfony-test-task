<?php

/**
 * WhmcsDomainTld filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWhmcsDomainTldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'extension'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dnsmanagement'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'emailforwarding' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idprotection'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'eppcode'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autoreg'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'order'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'extension'       => new sfValidatorPass(array('required' => false)),
      'dnsmanagement'   => new sfValidatorPass(array('required' => false)),
      'emailforwarding' => new sfValidatorPass(array('required' => false)),
      'idprotection'    => new sfValidatorPass(array('required' => false)),
      'eppcode'         => new sfValidatorPass(array('required' => false)),
      'autoreg'         => new sfValidatorPass(array('required' => false)),
      'order'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('whmcs_domain_tld_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsDomainTld';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'extension'       => 'Text',
      'dnsmanagement'   => 'Text',
      'emailforwarding' => 'Text',
      'idprotection'    => 'Text',
      'eppcode'         => 'Text',
      'autoreg'         => 'Text',
      'order'           => 'Number',
    );
  }
}
