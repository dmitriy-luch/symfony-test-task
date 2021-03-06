<?php

/**
 * WhmcsProductInternal filter form base class.
 *
 * @package    shop
 * @subpackage filter
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWhmcsProductInternalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gid'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ShopGroup'), 'add_empty' => true)),
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hidden'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'showdomainoptions'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'welcomeemail'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stockcontrol'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'qty'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proratabilling'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proratadate'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'proratachargenextmonth' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'paytype'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'allowqty'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subdomain'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autosetup'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'servertype'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'servergroup'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption1'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption2'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption3'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption4'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption5'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption6'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption7'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption8'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption9'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption10'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption11'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption12'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption13'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption14'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption15'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption16'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption17'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption18'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption19'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption20'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption21'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption22'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption23'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoption24'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'freedomain'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'freedomainpaymentterms' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'freedomaintlds'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recurringcycles'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autoterminatedays'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autoterminateemail'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'upgradepackages'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'configoptionsupgrade'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'billingcycleupgrade'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'upgradechargefullcycle' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'upgradeemail'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overagesenabled'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overagesdisklimit'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overagesbwlimit'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overagesdiskprice'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'overagesbwprice'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tax'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'affiliateonetime'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'affiliatepaytype'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'affiliatepayamount'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'downloads'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'order'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'retired'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'type'                   => new sfValidatorPass(array('required' => false)),
      'gid'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ShopGroup'), 'column' => 'id')),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'description'            => new sfValidatorPass(array('required' => false)),
      'hidden'                 => new sfValidatorPass(array('required' => false)),
      'showdomainoptions'      => new sfValidatorPass(array('required' => false)),
      'welcomeemail'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stockcontrol'           => new sfValidatorPass(array('required' => false)),
      'qty'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'proratabilling'         => new sfValidatorPass(array('required' => false)),
      'proratadate'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'proratachargenextmonth' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'paytype'                => new sfValidatorPass(array('required' => false)),
      'allowqty'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subdomain'              => new sfValidatorPass(array('required' => false)),
      'autosetup'              => new sfValidatorPass(array('required' => false)),
      'servertype'             => new sfValidatorPass(array('required' => false)),
      'servergroup'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'configoption1'          => new sfValidatorPass(array('required' => false)),
      'configoption2'          => new sfValidatorPass(array('required' => false)),
      'configoption3'          => new sfValidatorPass(array('required' => false)),
      'configoption4'          => new sfValidatorPass(array('required' => false)),
      'configoption5'          => new sfValidatorPass(array('required' => false)),
      'configoption6'          => new sfValidatorPass(array('required' => false)),
      'configoption7'          => new sfValidatorPass(array('required' => false)),
      'configoption8'          => new sfValidatorPass(array('required' => false)),
      'configoption9'          => new sfValidatorPass(array('required' => false)),
      'configoption10'         => new sfValidatorPass(array('required' => false)),
      'configoption11'         => new sfValidatorPass(array('required' => false)),
      'configoption12'         => new sfValidatorPass(array('required' => false)),
      'configoption13'         => new sfValidatorPass(array('required' => false)),
      'configoption14'         => new sfValidatorPass(array('required' => false)),
      'configoption15'         => new sfValidatorPass(array('required' => false)),
      'configoption16'         => new sfValidatorPass(array('required' => false)),
      'configoption17'         => new sfValidatorPass(array('required' => false)),
      'configoption18'         => new sfValidatorPass(array('required' => false)),
      'configoption19'         => new sfValidatorPass(array('required' => false)),
      'configoption20'         => new sfValidatorPass(array('required' => false)),
      'configoption21'         => new sfValidatorPass(array('required' => false)),
      'configoption22'         => new sfValidatorPass(array('required' => false)),
      'configoption23'         => new sfValidatorPass(array('required' => false)),
      'configoption24'         => new sfValidatorPass(array('required' => false)),
      'freedomain'             => new sfValidatorPass(array('required' => false)),
      'freedomainpaymentterms' => new sfValidatorPass(array('required' => false)),
      'freedomaintlds'         => new sfValidatorPass(array('required' => false)),
      'recurringcycles'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'autoterminatedays'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'autoterminateemail'     => new sfValidatorPass(array('required' => false)),
      'upgradepackages'        => new sfValidatorPass(array('required' => false)),
      'configoptionsupgrade'   => new sfValidatorPass(array('required' => false)),
      'billingcycleupgrade'    => new sfValidatorPass(array('required' => false)),
      'upgradechargefullcycle' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'upgradeemail'           => new sfValidatorPass(array('required' => false)),
      'overagesenabled'        => new sfValidatorPass(array('required' => false)),
      'overagesdisklimit'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overagesbwlimit'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overagesdiskprice'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'overagesbwprice'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tax'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'affiliateonetime'       => new sfValidatorPass(array('required' => false)),
      'affiliatepaytype'       => new sfValidatorPass(array('required' => false)),
      'affiliatepayamount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'downloads'              => new sfValidatorPass(array('required' => false)),
      'order'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'retired'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('whmcs_product_internal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhmcsProductInternal';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'type'                   => 'Text',
      'gid'                    => 'ForeignKey',
      'name'                   => 'Text',
      'description'            => 'Text',
      'hidden'                 => 'Text',
      'showdomainoptions'      => 'Text',
      'welcomeemail'           => 'Number',
      'stockcontrol'           => 'Text',
      'qty'                    => 'Number',
      'proratabilling'         => 'Text',
      'proratadate'            => 'Number',
      'proratachargenextmonth' => 'Number',
      'paytype'                => 'Text',
      'allowqty'               => 'Number',
      'subdomain'              => 'Text',
      'autosetup'              => 'Text',
      'servertype'             => 'Text',
      'servergroup'            => 'Number',
      'configoption1'          => 'Text',
      'configoption2'          => 'Text',
      'configoption3'          => 'Text',
      'configoption4'          => 'Text',
      'configoption5'          => 'Text',
      'configoption6'          => 'Text',
      'configoption7'          => 'Text',
      'configoption8'          => 'Text',
      'configoption9'          => 'Text',
      'configoption10'         => 'Text',
      'configoption11'         => 'Text',
      'configoption12'         => 'Text',
      'configoption13'         => 'Text',
      'configoption14'         => 'Text',
      'configoption15'         => 'Text',
      'configoption16'         => 'Text',
      'configoption17'         => 'Text',
      'configoption18'         => 'Text',
      'configoption19'         => 'Text',
      'configoption20'         => 'Text',
      'configoption21'         => 'Text',
      'configoption22'         => 'Text',
      'configoption23'         => 'Text',
      'configoption24'         => 'Text',
      'freedomain'             => 'Text',
      'freedomainpaymentterms' => 'Text',
      'freedomaintlds'         => 'Text',
      'recurringcycles'        => 'Number',
      'autoterminatedays'      => 'Number',
      'autoterminateemail'     => 'Text',
      'upgradepackages'        => 'Text',
      'configoptionsupgrade'   => 'Text',
      'billingcycleupgrade'    => 'Text',
      'upgradechargefullcycle' => 'Number',
      'upgradeemail'           => 'Text',
      'overagesenabled'        => 'Text',
      'overagesdisklimit'      => 'Number',
      'overagesbwlimit'        => 'Number',
      'overagesdiskprice'      => 'Number',
      'overagesbwprice'        => 'Number',
      'tax'                    => 'Number',
      'affiliateonetime'       => 'Text',
      'affiliatepaytype'       => 'Text',
      'affiliatepayamount'     => 'Number',
      'downloads'              => 'Text',
      'order'                  => 'Number',
      'retired'                => 'Number',
    );
  }
}
