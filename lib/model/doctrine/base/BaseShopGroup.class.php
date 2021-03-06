<?php

/**
 * BaseShopGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $orderfrmtpl
 * @property string $disabledgateways
 * @property string $hidden
 * @property int $order
 * @property Doctrine_Collection $WhmcsProductInternals
 * @property Doctrine_Collection $ShopCategories
 * @property Doctrine_Collection $CategoryRelations
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method string              getName()                  Returns the current record's "name" value
 * @method string              getOrderfrmtpl()           Returns the current record's "orderfrmtpl" value
 * @method string              getDisabledgateways()      Returns the current record's "disabledgateways" value
 * @method string              getHidden()                Returns the current record's "hidden" value
 * @method int                 getOrder()                 Returns the current record's "order" value
 * @method Doctrine_Collection getWhmcsProductInternals() Returns the current record's "WhmcsProductInternals" collection
 * @method Doctrine_Collection getShopCategories()        Returns the current record's "ShopCategories" collection
 * @method Doctrine_Collection getCategoryRelations()     Returns the current record's "CategoryRelations" collection
 * @method ShopGroup           setId()                    Sets the current record's "id" value
 * @method ShopGroup           setName()                  Sets the current record's "name" value
 * @method ShopGroup           setOrderfrmtpl()           Sets the current record's "orderfrmtpl" value
 * @method ShopGroup           setDisabledgateways()      Sets the current record's "disabledgateways" value
 * @method ShopGroup           setHidden()                Sets the current record's "hidden" value
 * @method ShopGroup           setOrder()                 Sets the current record's "order" value
 * @method ShopGroup           setWhmcsProductInternals() Sets the current record's "WhmcsProductInternals" collection
 * @method ShopGroup           setShopCategories()        Sets the current record's "ShopCategories" collection
 * @method ShopGroup           setCategoryRelations()     Sets the current record's "CategoryRelations" collection
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseShopGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tblproductgroups');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('orderfrmtpl', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('disabledgateways', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('hidden', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('order', 'int', 1, array(
             'type' => 'int',
             'default' => 0,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('WhmcsProductInternal as WhmcsProductInternals', array(
             'local' => 'id',
             'foreign' => 'gid'));

        $this->hasMany('ShopCategory as ShopCategories', array(
             'refClass' => 'CategoryRelations',
             'local' => 'whmcs_gid',
             'foreign' => 'category_id'));

        $this->hasMany('CategoryRelations', array(
             'local' => 'id',
             'foreign' => 'whmcs_gid'));
    }
}