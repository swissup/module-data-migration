<?php

namespace Swissup\DataMigration\Handler\ProLabels;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;
use Migration\ResourceModel\Source;

class Stores extends AbstractHandler implements HandlerInterface
{

    /**
     * @var Source
     */
    protected $source;

    public function __construct(Source $source)
    {
        $this->source = $source;
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
                [$this->source->addDocumentPrefix('tm_prolabels_rules_store')],
                ['store_id']
                )
            ->where('rule_id = ?', $recordToHandle->getValue('label_id'))
            ;

        $data = $query->getAdapter()->fetchCol($query);
        $recordToHandle->setValue($this->field, serialize($data));

    }

}
