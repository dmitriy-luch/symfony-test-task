<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version4 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeColumn('page_translation', 'url');
        $this->addColumn('page', 'url', 'varchar', '255', array(
             'unique' => '1',
             ));
    }

    public function down()
    {
        $this->addColumn('page_translation', 'url', 'varchar', '255', array(
             'unique' => '1',
             ));
        $this->removeColumn('page', 'url');
    }
}