<?php

/**
 * WhmcsDomainTld form base class.
 *
 * @method WhmcsDomainTld getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWhmcsDomainTldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'extension'       => new sfWidgetFormTextarea(),
      'dnsmanagement'   => new sfWidgetFormTextarea(),
      'emailforwarding' => new sfWidgetFormTextarea(),
      'idprotection'    => new sfWidgetFormTextarea(),
      'eppcode'         => new sfWidgetFormTextarea(),
      'autoreg'         => new sfWidgetFormTextarea(),
      'order'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'extension'       => new sfValidatorString(),
      'dnsmanagement'   => new sfValidatorString(),
      'emailforwarding' => new sfValidatorString(),
      'idprotection'    => new sfValidatorString(),
      'eppcode'         => new sfValidatorString(),
      'autoreg'         => new sfValidatorString(),
      'order'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('whmcs_domain_tld[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsDomainTld';
  }

}
