<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version1 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeColumn('page', 'meta');
        $this->addColumn('page', 'meta_description', 'varchar', '255', array(
             ));
        $this->addColumn('page', 'meta_keywords', 'varchar', '255', array(
             ));
        $this->changeColumn('page', 'url', 'varchar', '255', array(
             'unique' => '1',
             ));
    }

    public function down()
    {
        $this->addColumn('page', 'meta', 'varchar', '255', array(
             ));
        $this->removeColumn('page', 'meta_description');
        $this->removeColumn('page', 'meta_keywords');
    }
}