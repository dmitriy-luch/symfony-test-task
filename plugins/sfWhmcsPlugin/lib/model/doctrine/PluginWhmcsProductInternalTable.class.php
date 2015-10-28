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

    /**
     * Overrode method createQuery to exclude hidden products
     *
     * @param string $alias Base table alias
     * @return Doctrine_Query
     */
    public function createQuery($alias = '')
    {
        $query = parent::createQuery($alias);
        return $query->andWhere('hidden != ?', 'on');
    }

    /**
     * Find all products for provided groups in format required by ShopProduct
     *
     * @param $groupIds array List of group IDs to search products for
     * @return array
     */
    public function findAllByGroupIds($groupIds)
    {
        if(!is_array($groupIds) || !count($groupIds))
        {
            return [];
        }
        return $this->createQuery('pr')
            ->select('pr.name as name')
            ->addSelect('pr.description as description')
            ->addSelect('"product" as type')
            ->addSelect('pr.id as id')
            ->addSelect('p.*')
            ->leftJoin('pr.Prices as p')
            ->andWhere('p.type = ?', PluginWhmcsPrice::getNewProductType())
            ->andWhereIn('gid', $groupIds)
            ->fetchArray();
    }
}