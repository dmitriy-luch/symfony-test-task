<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version8 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('category', 'special', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('category', 'special');
    }
}