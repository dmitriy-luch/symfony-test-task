<?php

/**
 * WhmcsProduct form base class.
 *
 * @method WhmcsProduct getObject() Returns the current form's model object
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWhmcsProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'type'                   => new sfWidgetFormTextarea(),
      'gid'                    => new sfWidgetFormInputText(),
      'name'                   => new sfWidgetFormTextarea(),
      'description'            => new sfWidgetFormTextarea(),
      'hidden'                 => new sfWidgetFormTextarea(),
      'showdomainoptions'      => new sfWidgetFormTextarea(),
      'welcomeemail'           => new sfWidgetFormInputText(),
      'stockcontrol'           => new sfWidgetFormTextarea(),
      'qty'                    => new sfWidgetFormInputText(),
      'proratabilling'         => new sfWidgetFormTextarea(),
      'proratadate'            => new sfWidgetFormInputText(),
      'proratachargenextmonth' => new sfWidgetFormInputText(),
      'paytype'                => new sfWidgetFormTextarea(),
      'allowqty'               => new sfWidgetFormInputText(),
      'subdomain'              => new sfWidgetFormTextarea(),
      'autosetup'              => new sfWidgetFormTextarea(),
      'servertype'             => new sfWidgetFormTextarea(),
      'servergroup'            => new sfWidgetFormInputText(),
      'configoption1'          => new sfWidgetFormTextarea(),
      'configoption2'          => new sfWidgetFormTextarea(),
      'configoption3'          => new sfWidgetFormTextarea(),
      'configoption4'          => new sfWidgetFormTextarea(),
      'configoption5'          => new sfWidgetFormTextarea(),
      'configoption6'          => new sfWidgetFormTextarea(),
      'configoption7'          => new sfWidgetFormTextarea(),
      'configoption8'          => new sfWidgetFormTextarea(),
      'configoption9'          => new sfWidgetFormTextarea(),
      'configoption10'         => new sfWidgetFormTextarea(),
      'configoption11'         => new sfWidgetFormTextarea(),
      'configoption12'         => new sfWidgetFormTextarea(),
      'configoption13'         => new sfWidgetFormTextarea(),
      'configoption14'         => new sfWidgetFormTextarea(),
      'configoption15'         => new sfWidgetFormTextarea(),
      'configoption16'         => new sfWidgetFormTextarea(),
      'configoption17'         => new sfWidgetFormTextarea(),
      'configoption18'         => new sfWidgetFormTextarea(),
      'configoption19'         => new sfWidgetFormTextarea(),
      'configoption20'         => new sfWidgetFormTextarea(),
      'configoption21'         => new sfWidgetFormTextarea(),
      'configoption22'         => new sfWidgetFormTextarea(),
      'configoption23'         => new sfWidgetFormTextarea(),
      'configoption24'         => new sfWidgetFormTextarea(),
      'freedomain'             => new sfWidgetFormTextarea(),
      'freedomainpaymentterms' => new sfWidgetFormTextarea(),
      'freedomaintlds'         => new sfWidgetFormTextarea(),
      'recurringcycles'        => new sfWidgetFormInputText(),
      'autoterminatedays'      => new sfWidgetFormInputText(),
      'autoterminateemail'     => new sfWidgetFormTextarea(),
      'upgradepackages'        => new sfWidgetFormTextarea(),
      'configoptionsupgrade'   => new sfWidgetFormTextarea(),
      'billingcycleupgrade'    => new sfWidgetFormTextarea(),
      'upgradechargefullcycle' => new sfWidgetFormInputText(),
      'upgradeemail'           => new sfWidgetFormTextarea(),
      'overagesenabled'        => new sfWidgetFormInputText(),
      'overagesdisklimit'      => new sfWidgetFormInputText(),
      'overagesbwlimit'        => new sfWidgetFormInputText(),
      'overagesdiskprice'      => new sfWidgetFormInputText(),
      'overagesbwprice'        => new sfWidgetFormInputText(),
      'tax'                    => new sfWidgetFormInputText(),
      'affiliateonetime'       => new sfWidgetFormTextarea(),
      'affiliatepaytype'       => new sfWidgetFormTextarea(),
      'affiliatepayamount'     => new sfWidgetFormInputText(),
      'downloads'              => new sfWidgetFormTextarea(),
      'order'                  => new sfWidgetFormInputText(),
      'retired'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'                   => new sfValidatorString(),
      'gid'                    => new sfValidatorInteger(),
      'name'                   => new sfValidatorString(),
      'description'            => new sfValidatorString(),
      'hidden'                 => new sfValidatorString(),
      'showdomainoptions'      => new sfValidatorString(),
      'welcomeemail'           => new sfValidatorInteger(array('required' => false)),
      'stockcontrol'           => new sfValidatorString(),
      'qty'                    => new sfValidatorInteger(array('required' => false)),
      'proratabilling'         => new sfValidatorString(),
      'proratadate'            => new sfValidatorInteger(),
      'proratachargenextmonth' => new sfValidatorInteger(),
      'paytype'                => new sfValidatorString(),
      'allowqty'               => new sfValidatorInteger(),
      'subdomain'              => new sfValidatorString(),
      'autosetup'              => new sfValidatorString(),
      'servertype'             => new sfValidatorString(),
      'servergroup'            => new sfValidatorInteger(),
      'configoption1'          => new sfValidatorString(),
      'configoption2'          => new sfValidatorString(),
      'configoption3'          => new sfValidatorString(),
      'configoption4'          => new sfValidatorString(),
      'configoption5'          => new sfValidatorString(),
      'configoption6'          => new sfValidatorString(),
      'configoption7'          => new sfValidatorString(),
      'configoption8'          => new sfValidatorString(),
      'configoption9'          => new sfValidatorString(),
      'configoption10'         => new sfValidatorString(),
      'configoption11'         => new sfValidatorString(),
      'configoption12'         => new sfValidatorString(),
      'configoption13'         => new sfValidatorString(),
      'configoption14'         => new sfValidatorString(),
      'configoption15'         => new sfValidatorString(),
      'configoption16'         => new sfValidatorString(),
      'configoption17'         => new sfValidatorString(),
      'configoption18'         => new sfValidatorString(),
      'configoption19'         => new sfValidatorString(),
      'configoption20'         => new sfValidatorString(),
      'configoption21'         => new sfValidatorString(),
      'configoption22'         => new sfValidatorString(),
      'configoption23'         => new sfValidatorString(),
      'configoption24'         => new sfValidatorString(),
      'freedomain'             => new sfValidatorString(),
      'freedomainpaymentterms' => new sfValidatorString(),
      'freedomaintlds'         => new sfValidatorString(),
      'recurringcycles'        => new sfValidatorInteger(),
      'autoterminatedays'      => new sfValidatorInteger(),
      'autoterminateemail'     => new sfValidatorString(),
      'upgradepackages'        => new sfValidatorString(),
      'configoptionsupgrade'   => new sfValidatorString(),
      'billingcycleupgrade'    => new sfValidatorString(),
      'upgradechargefullcycle' => new sfValidatorInteger(),
      'upgradeemail'           => new sfValidatorString(),
      'overagesenabled'        => new sfValidatorString(array('max_length' => 10)),
      'overagesdisklimit'      => new sfValidatorInteger(),
      'overagesbwlimit'        => new sfValidatorInteger(),
      'overagesdiskprice'      => new sfValidatorNumber(),
      'overagesbwprice'        => new sfValidatorNumber(),
      'tax'                    => new sfValidatorInteger(),
      'affiliateonetime'       => new sfValidatorString(),
      'affiliatepaytype'       => new sfValidatorString(),
      'affiliatepayamount'     => new sfValidatorNumber(),
      'downloads'              => new sfValidatorString(),
      'order'                  => new sfValidatorInteger(),
      'retired'                => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('whmcs_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsProduct';
  }

}
