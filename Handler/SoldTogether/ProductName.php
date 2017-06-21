<?php

namespace Swissup\DataMigration\Handler\SoldTogether;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;
use Migration\ResourceModel\Source;
use Migration\Config;

class ProductName extends AbstractHandler implements HandlerInterface
{

    /**
     * @var Source
     */
    protected $source;

    public function __construct(Config $config, Source $source, $productIdFieldName)
    {
        $this->source = $source;
        $this->productIdFieldName = $productIdFieldName;
    }

    /**
     * [handle description]
     * @param  Record $recordToHandle destination record (in this case)
     * @param  Record $oppositeRecord source record (in this case)
     */
    public function handle(Record $recordToHandle, Record $oppositeRecord)
    {
        $adapter = $this->source->getAdapter();

        // get product name from source
        $query = $adapter->getSelect()
            ->from(
                ['p' => $this->source->addDocumentPrefix('catalog_product_entity_varchar')],
                ['p.value']
                )
            ->join(
                ['a' => $this->source->addDocumentPrefix('eav_attribute')],
                'p.attribute_id = a.attribute_id'
                )
            ->where('p.entity_id = ?', $recordToHandle->getValue($this->productIdFieldName))
            ->where('p.store_id = ?', '0')
            ->where('a.attribute_code = ?', 'name')
            ;

        $data = $query->getAdapter()->fetchRow($query);

        if (isset($data['value'])) {
            $recordToHandle->setValue($this->field, $data['value']);
        }

    }

}
