<?php

/**
 * PluginWhmcsPriceTable
 */
class PluginWhmcsPriceTable extends Doctrine_Table
{
    /**
     * @return array Price fields from WHMCS Price table
     */
    public static function getPriceFields()
    {
        return [
            'msetupfee',
            'qsetupfee',
            'ssetupfee',
            'asetupfee',
            'bsetupfee',
            'tsetupfee',
            'monthly',
            'quarterly',
            'semiannually',
            'annually',
            'biennially',
            'triennially'
        ];
    }

    /**
     * Returns an instance of this class.
     *
     * @return object PluginWhmcsPriceTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginWhmcsPrice');
    }

    /**
     * Returns a list prices for provided groups (domains) and currency ordered ASC by Price
     *
     * @param array $options for Query
     * - groups array List of WHMCS Group Ids
     * - currency int WHMCS Currency Id
     * - domains bool Whether to include domains or not
     *
     * @return array
     */
    public function getCheapestProductsPrices($options = null)
    {
        // Price table alias
        $pricesAlias = 'p';
        // Array of price values
        $prices = [];
        // Array to use for whereIn condition
        $typeIn = [];
        // Initiate query
        $query = $this->createQuery($pricesAlias);
        // If domains option provided and is true
        if(is_array($options) && isset($options['domains']) && $options['domains'])
        {
            // Add Domain types (for Prices table) to whereIn condition Array
            $typeIn = array_merge($typeIn, PluginWhmcsPrice::getDomainPriceTypes());
        }
        // If currency option is provided
        if(is_array($options) && isset($options['currency']))
        {
            // Add currency check to condition
            $query->andWhere("$pricesAlias.currency = ?", $options['currency']);
        }
        // If groups option is provided, it is an array and have at least 1 item
        if(
            is_array($options)
            && isset($options['groups'])
            && is_array($options['groups'])
            && count($options['groups'])
        ) {
            // Add Product type (for Prices table) to whereIn condition Array
            $typeIn = array_merge($typeIn, PluginWhmcsPrice::getProductTypes());
            // Join Products from WHMCS DB with ON condition containing groups from options
            $query->leftJoin("$pricesAlias.WhmcsProductInternal prod WITH prod.gid IN (?)", join(',', $options['groups']));
        }

        // If array for whereIn condition is not empty
        if(count($typeIn))
        {
            // Add Types to whereIn condition
            $query->andWhereIn("$pricesAlias.type", $typeIn);
        }

        // Proceed with calculations for each of the price fields
        foreach ($this->getPriceFields() as $priceField)
        {
            // Combine field name with table alias
            $fieldString = $pricesAlias . '.' . $priceField;
            // Clone predefined query
            $currentQuery = clone($query);
            // Add condition for price field to exclude -1 values. Add ordering by this field
            $currentQuery->andWhere("$fieldString > ?", 0)
                ->orderBy($fieldString);
            // Get array of prices
            $currentFieldOrderedPrices = $currentQuery->fetchArray();
            // Proceed with comparing new values to the previous ones
            foreach ($currentFieldOrderedPrices as $currentOrderedPrice)
            {
                // Check if current ID already exists and if new item is cheaper
                if(
                    !isset($prices[$currentOrderedPrice['id']])
                    || $prices[$currentOrderedPrice['id']] > $currentOrderedPrice[$priceField]
                ) {
                    // Save the cheapest value
                    $prices[$currentOrderedPrice['id']] = $currentOrderedPrice[$priceField];
                }
            }
        }

        // Sort cheapest prices ASC
        asort($prices);

        // return prices array
        return $prices;
    }
}