<?php

/**
 * WhmcsPriceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WhmcsPriceTable extends PluginWhmcsPriceTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WhmcsPriceTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WhmcsPrice');
    }
}