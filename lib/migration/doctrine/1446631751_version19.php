<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version19 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('cart_product', 'cart_product_cart_id_shop_cart_id');
        $this->createForeignKey('cart_product', 'cart_product_cart_id_shop_cart_id_1', array(
             'name' => 'cart_product_cart_id_shop_cart_id_1',
             'local' => 'cart_id',
             'foreign' => 'id',
             'foreignTable' => 'shop_cart',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
    }

    public function down()
    {
        $this->createForeignKey('cart_product', 'cart_product_cart_id_shop_cart_id', array(
             'name' => 'cart_product_cart_id_shop_cart_id',
             'local' => 'cart_id',
             'foreign' => 'id',
             'foreignTable' => 'shop_cart',
             ));
        $this->dropForeignKey('cart_product', 'cart_product_cart_id_shop_cart_id_1');
    }
}