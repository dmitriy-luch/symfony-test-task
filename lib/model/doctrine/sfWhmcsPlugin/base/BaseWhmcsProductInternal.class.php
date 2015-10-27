<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('WhmcsProductInternal', 'doctrine');

/**
 * BaseWhmcsProductInternal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $type
 * @property integer $gid
 * @property string $name
 * @property string $description
 * @property string $hidden
 * @property string $showdomainoptions
 * @property integer $welcomeemail
 * @property string $stockcontrol
 * @property integer $qty
 * @property string $proratabilling
 * @property integer $proratadate
 * @property integer $proratachargenextmonth
 * @property string $paytype
 * @property integer $allowqty
 * @property string $subdomain
 * @property string $autosetup
 * @property string $servertype
 * @property integer $servergroup
 * @property string $configoption1
 * @property string $configoption2
 * @property string $configoption3
 * @property string $configoption4
 * @property string $configoption5
 * @property string $configoption6
 * @property string $configoption7
 * @property string $configoption8
 * @property string $configoption9
 * @property string $configoption10
 * @property string $configoption11
 * @property string $configoption12
 * @property string $configoption13
 * @property string $configoption14
 * @property string $configoption15
 * @property string $configoption16
 * @property string $configoption17
 * @property string $configoption18
 * @property string $configoption19
 * @property string $configoption20
 * @property string $configoption21
 * @property string $configoption22
 * @property string $configoption23
 * @property string $configoption24
 * @property string $freedomain
 * @property string $freedomainpaymentterms
 * @property string $freedomaintlds
 * @property integer $recurringcycles
 * @property integer $autoterminatedays
 * @property string $autoterminateemail
 * @property string $upgradepackages
 * @property string $configoptionsupgrade
 * @property string $billingcycleupgrade
 * @property integer $upgradechargefullcycle
 * @property string $upgradeemail
 * @property string $overagesenabled
 * @property integer $overagesdisklimit
 * @property integer $overagesbwlimit
 * @property decimal $overagesdiskprice
 * @property decimal $overagesbwprice
 * @property integer $tax
 * @property string $affiliateonetime
 * @property string $affiliatepaytype
 * @property decimal $affiliatepayamount
 * @property string $downloads
 * @property integer $order
 * @property integer $retired
 * @property Doctrine_Collection $Prices
 * @property ShopGroup $ShopGroup
 * 
 * @method integer              getId()                     Returns the current record's "id" value
 * @method string               getType()                   Returns the current record's "type" value
 * @method integer              getGid()                    Returns the current record's "gid" value
 * @method string               getName()                   Returns the current record's "name" value
 * @method string               getDescription()            Returns the current record's "description" value
 * @method string               getHidden()                 Returns the current record's "hidden" value
 * @method string               getShowdomainoptions()      Returns the current record's "showdomainoptions" value
 * @method integer              getWelcomeemail()           Returns the current record's "welcomeemail" value
 * @method string               getStockcontrol()           Returns the current record's "stockcontrol" value
 * @method integer              getQty()                    Returns the current record's "qty" value
 * @method string               getProratabilling()         Returns the current record's "proratabilling" value
 * @method integer              getProratadate()            Returns the current record's "proratadate" value
 * @method integer              getProratachargenextmonth() Returns the current record's "proratachargenextmonth" value
 * @method string               getPaytype()                Returns the current record's "paytype" value
 * @method integer              getAllowqty()               Returns the current record's "allowqty" value
 * @method string               getSubdomain()              Returns the current record's "subdomain" value
 * @method string               getAutosetup()              Returns the current record's "autosetup" value
 * @method string               getServertype()             Returns the current record's "servertype" value
 * @method integer              getServergroup()            Returns the current record's "servergroup" value
 * @method string               getConfigoption1()          Returns the current record's "configoption1" value
 * @method string               getConfigoption2()          Returns the current record's "configoption2" value
 * @method string               getConfigoption3()          Returns the current record's "configoption3" value
 * @method string               getConfigoption4()          Returns the current record's "configoption4" value
 * @method string               getConfigoption5()          Returns the current record's "configoption5" value
 * @method string               getConfigoption6()          Returns the current record's "configoption6" value
 * @method string               getConfigoption7()          Returns the current record's "configoption7" value
 * @method string               getConfigoption8()          Returns the current record's "configoption8" value
 * @method string               getConfigoption9()          Returns the current record's "configoption9" value
 * @method string               getConfigoption10()         Returns the current record's "configoption10" value
 * @method string               getConfigoption11()         Returns the current record's "configoption11" value
 * @method string               getConfigoption12()         Returns the current record's "configoption12" value
 * @method string               getConfigoption13()         Returns the current record's "configoption13" value
 * @method string               getConfigoption14()         Returns the current record's "configoption14" value
 * @method string               getConfigoption15()         Returns the current record's "configoption15" value
 * @method string               getConfigoption16()         Returns the current record's "configoption16" value
 * @method string               getConfigoption17()         Returns the current record's "configoption17" value
 * @method string               getConfigoption18()         Returns the current record's "configoption18" value
 * @method string               getConfigoption19()         Returns the current record's "configoption19" value
 * @method string               getConfigoption20()         Returns the current record's "configoption20" value
 * @method string               getConfigoption21()         Returns the current record's "configoption21" value
 * @method string               getConfigoption22()         Returns the current record's "configoption22" value
 * @method string               getConfigoption23()         Returns the current record's "configoption23" value
 * @method string               getConfigoption24()         Returns the current record's "configoption24" value
 * @method string               getFreedomain()             Returns the current record's "freedomain" value
 * @method string               getFreedomainpaymentterms() Returns the current record's "freedomainpaymentterms" value
 * @method string               getFreedomaintlds()         Returns the current record's "freedomaintlds" value
 * @method integer              getRecurringcycles()        Returns the current record's "recurringcycles" value
 * @method integer              getAutoterminatedays()      Returns the current record's "autoterminatedays" value
 * @method string               getAutoterminateemail()     Returns the current record's "autoterminateemail" value
 * @method string               getUpgradepackages()        Returns the current record's "upgradepackages" value
 * @method string               getConfigoptionsupgrade()   Returns the current record's "configoptionsupgrade" value
 * @method string               getBillingcycleupgrade()    Returns the current record's "billingcycleupgrade" value
 * @method integer              getUpgradechargefullcycle() Returns the current record's "upgradechargefullcycle" value
 * @method string               getUpgradeemail()           Returns the current record's "upgradeemail" value
 * @method string               getOveragesenabled()        Returns the current record's "overagesenabled" value
 * @method integer              getOveragesdisklimit()      Returns the current record's "overagesdisklimit" value
 * @method integer              getOveragesbwlimit()        Returns the current record's "overagesbwlimit" value
 * @method decimal              getOveragesdiskprice()      Returns the current record's "overagesdiskprice" value
 * @method decimal              getOveragesbwprice()        Returns the current record's "overagesbwprice" value
 * @method integer              getTax()                    Returns the current record's "tax" value
 * @method string               getAffiliateonetime()       Returns the current record's "affiliateonetime" value
 * @method string               getAffiliatepaytype()       Returns the current record's "affiliatepaytype" value
 * @method decimal              getAffiliatepayamount()     Returns the current record's "affiliatepayamount" value
 * @method string               getDownloads()              Returns the current record's "downloads" value
 * @method integer              getOrder()                  Returns the current record's "order" value
 * @method integer              getRetired()                Returns the current record's "retired" value
 * @method Doctrine_Collection  getPrices()                 Returns the current record's "Prices" collection
 * @method ShopGroup            getShopGroup()              Returns the current record's "ShopGroup" value
 * @method WhmcsProductInternal setId()                     Sets the current record's "id" value
 * @method WhmcsProductInternal setType()                   Sets the current record's "type" value
 * @method WhmcsProductInternal setGid()                    Sets the current record's "gid" value
 * @method WhmcsProductInternal setName()                   Sets the current record's "name" value
 * @method WhmcsProductInternal setDescription()            Sets the current record's "description" value
 * @method WhmcsProductInternal setHidden()                 Sets the current record's "hidden" value
 * @method WhmcsProductInternal setShowdomainoptions()      Sets the current record's "showdomainoptions" value
 * @method WhmcsProductInternal setWelcomeemail()           Sets the current record's "welcomeemail" value
 * @method WhmcsProductInternal setStockcontrol()           Sets the current record's "stockcontrol" value
 * @method WhmcsProductInternal setQty()                    Sets the current record's "qty" value
 * @method WhmcsProductInternal setProratabilling()         Sets the current record's "proratabilling" value
 * @method WhmcsProductInternal setProratadate()            Sets the current record's "proratadate" value
 * @method WhmcsProductInternal setProratachargenextmonth() Sets the current record's "proratachargenextmonth" value
 * @method WhmcsProductInternal setPaytype()                Sets the current record's "paytype" value
 * @method WhmcsProductInternal setAllowqty()               Sets the current record's "allowqty" value
 * @method WhmcsProductInternal setSubdomain()              Sets the current record's "subdomain" value
 * @method WhmcsProductInternal setAutosetup()              Sets the current record's "autosetup" value
 * @method WhmcsProductInternal setServertype()             Sets the current record's "servertype" value
 * @method WhmcsProductInternal setServergroup()            Sets the current record's "servergroup" value
 * @method WhmcsProductInternal setConfigoption1()          Sets the current record's "configoption1" value
 * @method WhmcsProductInternal setConfigoption2()          Sets the current record's "configoption2" value
 * @method WhmcsProductInternal setConfigoption3()          Sets the current record's "configoption3" value
 * @method WhmcsProductInternal setConfigoption4()          Sets the current record's "configoption4" value
 * @method WhmcsProductInternal setConfigoption5()          Sets the current record's "configoption5" value
 * @method WhmcsProductInternal setConfigoption6()          Sets the current record's "configoption6" value
 * @method WhmcsProductInternal setConfigoption7()          Sets the current record's "configoption7" value
 * @method WhmcsProductInternal setConfigoption8()          Sets the current record's "configoption8" value
 * @method WhmcsProductInternal setConfigoption9()          Sets the current record's "configoption9" value
 * @method WhmcsProductInternal setConfigoption10()         Sets the current record's "configoption10" value
 * @method WhmcsProductInternal setConfigoption11()         Sets the current record's "configoption11" value
 * @method WhmcsProductInternal setConfigoption12()         Sets the current record's "configoption12" value
 * @method WhmcsProductInternal setConfigoption13()         Sets the current record's "configoption13" value
 * @method WhmcsProductInternal setConfigoption14()         Sets the current record's "configoption14" value
 * @method WhmcsProductInternal setConfigoption15()         Sets the current record's "configoption15" value
 * @method WhmcsProductInternal setConfigoption16()         Sets the current record's "configoption16" value
 * @method WhmcsProductInternal setConfigoption17()         Sets the current record's "configoption17" value
 * @method WhmcsProductInternal setConfigoption18()         Sets the current record's "configoption18" value
 * @method WhmcsProductInternal setConfigoption19()         Sets the current record's "configoption19" value
 * @method WhmcsProductInternal setConfigoption20()         Sets the current record's "configoption20" value
 * @method WhmcsProductInternal setConfigoption21()         Sets the current record's "configoption21" value
 * @method WhmcsProductInternal setConfigoption22()         Sets the current record's "configoption22" value
 * @method WhmcsProductInternal setConfigoption23()         Sets the current record's "configoption23" value
 * @method WhmcsProductInternal setConfigoption24()         Sets the current record's "configoption24" value
 * @method WhmcsProductInternal setFreedomain()             Sets the current record's "freedomain" value
 * @method WhmcsProductInternal setFreedomainpaymentterms() Sets the current record's "freedomainpaymentterms" value
 * @method WhmcsProductInternal setFreedomaintlds()         Sets the current record's "freedomaintlds" value
 * @method WhmcsProductInternal setRecurringcycles()        Sets the current record's "recurringcycles" value
 * @method WhmcsProductInternal setAutoterminatedays()      Sets the current record's "autoterminatedays" value
 * @method WhmcsProductInternal setAutoterminateemail()     Sets the current record's "autoterminateemail" value
 * @method WhmcsProductInternal setUpgradepackages()        Sets the current record's "upgradepackages" value
 * @method WhmcsProductInternal setConfigoptionsupgrade()   Sets the current record's "configoptionsupgrade" value
 * @method WhmcsProductInternal setBillingcycleupgrade()    Sets the current record's "billingcycleupgrade" value
 * @method WhmcsProductInternal setUpgradechargefullcycle() Sets the current record's "upgradechargefullcycle" value
 * @method WhmcsProductInternal setUpgradeemail()           Sets the current record's "upgradeemail" value
 * @method WhmcsProductInternal setOveragesenabled()        Sets the current record's "overagesenabled" value
 * @method WhmcsProductInternal setOveragesdisklimit()      Sets the current record's "overagesdisklimit" value
 * @method WhmcsProductInternal setOveragesbwlimit()        Sets the current record's "overagesbwlimit" value
 * @method WhmcsProductInternal setOveragesdiskprice()      Sets the current record's "overagesdiskprice" value
 * @method WhmcsProductInternal setOveragesbwprice()        Sets the current record's "overagesbwprice" value
 * @method WhmcsProductInternal setTax()                    Sets the current record's "tax" value
 * @method WhmcsProductInternal setAffiliateonetime()       Sets the current record's "affiliateonetime" value
 * @method WhmcsProductInternal setAffiliatepaytype()       Sets the current record's "affiliatepaytype" value
 * @method WhmcsProductInternal setAffiliatepayamount()     Sets the current record's "affiliatepayamount" value
 * @method WhmcsProductInternal setDownloads()              Sets the current record's "downloads" value
 * @method WhmcsProductInternal setOrder()                  Sets the current record's "order" value
 * @method WhmcsProductInternal setRetired()                Sets the current record's "retired" value
 * @method WhmcsProductInternal setPrices()                 Sets the current record's "Prices" collection
 * @method WhmcsProductInternal setShopGroup()              Sets the current record's "ShopGroup" value
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWhmcsProductInternal extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tblproducts');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('type', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('gid', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('hidden', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('showdomainoptions', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('welcomeemail', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('stockcontrol', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('qty', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('proratabilling', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('proratadate', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('proratachargenextmonth', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('paytype', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('allowqty', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('subdomain', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('autosetup', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('servertype', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('servergroup', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('configoption1', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption2', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption3', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption4', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption5', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption6', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption7', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption8', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption9', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption10', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption11', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption12', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption13', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption14', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption15', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption16', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption17', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption18', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption19', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption20', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption21', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption22', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption23', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoption24', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('freedomain', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('freedomainpaymentterms', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('freedomaintlds', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('recurringcycles', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('autoterminatedays', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('autoterminateemail', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('upgradepackages', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('configoptionsupgrade', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('billingcycleupgrade', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('upgradechargefullcycle', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('upgradeemail', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('overagesenabled', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('overagesdisklimit', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('overagesbwlimit', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('overagesdiskprice', 'decimal', 6, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 6,
             'scale' => '4',
             ));
        $this->hasColumn('overagesbwprice', 'decimal', 6, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 6,
             'scale' => '4',
             ));
        $this->hasColumn('tax', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('affiliateonetime', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('affiliatepaytype', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('affiliatepayamount', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('downloads', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('order', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('retired', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('WhmcsPrice as Prices', array(
             'local' => 'id',
             'foreign' => 'relid'));

        $this->hasOne('ShopGroup', array(
             'local' => 'gid',
             'foreign' => 'id'));
    }
}