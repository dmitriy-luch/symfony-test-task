<?php

/**
 * WhmcsProductInternalTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WhmcsProductInternalTable extends PluginWhmcsProductInternalTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WhmcsProductInternalTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WhmcsProductInternal');
    }
}