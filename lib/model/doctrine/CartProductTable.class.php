<?php

/**
 * CartProductTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CartProductTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CartProductTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('CartProduct');
    }
}