<?php

/**
 * PluginWhmcsDomainTldTable
 */
class PluginWhmcsDomainTldTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginWhmcsDomainTldTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWhmcsDomainTld');
    }

    /**
     * Find all domains in format required by ShopProduct
     *
     * @return array
     */
    public function findAllWithPrices()
    {
        return $this->findWithPricesQuery()->fetchArray();
    }

    public function findOneByIdWithPrices($id)
    {
        return $this->findWithPricesQuery()
            ->andWhere('id = ?', $id)
            ->fetchOne([], Doctrine_Core::HYDRATE_ARRAY);
    }

    protected function findWithPricesQuery()
    {
        return $this->createQuery('d')
            ->select('d.extension as name')
            ->addSelect('"" as productType')
            ->addSelect('"' . ShopProduct::TYPE_DOMAIN . '" as type')
            ->addSelect('d.id as id')
            ->addSelect('p.*')
            ->leftJoin('d.Prices as p')
            ->andWhere('p.type = ?', PluginWhmcsPrice::getNewDomainPriceType())
            ->orderBy('d.order');
    }
}