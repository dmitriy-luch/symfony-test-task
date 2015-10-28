<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version12 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addIndex('shop_category', 'shop_category_sluggable', array(
             'fields' => 
             array(
              0 => 'slug',
             ),
             'type' => 'unique',
             ));
    }

    public function down()
    {
        $this->removeIndex('shop_category', 'shop_category_sluggable', array(
             'fields' => 
             array(
              0 => 'slug',
             ),
             'type' => 'unique',
             ));
    }
}