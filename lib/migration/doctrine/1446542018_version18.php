<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version18 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('shop_cart', 'client_id', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('shop_cart', 'client_id');
    }
}