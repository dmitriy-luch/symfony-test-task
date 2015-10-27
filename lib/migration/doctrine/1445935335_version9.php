<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version9 extends Doctrine_Migration_Base
{
    public function up()
    {
      $this->dropTable('category');
      $this->dropTable('category_translation');
      $this->createTable('shop_category', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'is_shown_on_frontend' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'is_popular' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'include_domains' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'special' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'image' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('shop_category_translation', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'lang' => 
             array(
              'fixed' => '1',
              'primary' => '1',
              'type' => 'string',
              'length' => '2',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
              1 => 'lang',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->createTable('category', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'is_shown_on_frontend' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'is_popular' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'include_domains' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'special' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '0',
              'length' => '25',
             ),
             'image' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('category_translation', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'lang' => 
             array(
              'fixed' => '1',
              'primary' => '1',
              'type' => 'string',
              'length' => '2',
             ),
             ), array(
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
              1 => 'lang',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
        $this->dropTable('shop_category');
        $this->dropTable('shop_category_translation');
    }
}