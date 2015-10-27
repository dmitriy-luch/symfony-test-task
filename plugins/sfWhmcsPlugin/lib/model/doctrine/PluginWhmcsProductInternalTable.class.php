<?php

/**
 * PluginWhmcsProductInternalTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginWhmcsProductInternalTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginWhmcsProductInternalTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWhmcsProductInternal');
    }

    public function createQuery($alias = '')
    {
        $query = parent::createQuery($alias);
        return $query->andWhere('hidden != ?', 'on');
    }
}