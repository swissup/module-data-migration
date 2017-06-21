<?php

namespace Swissup\DataMigration\Handler\Easybanner;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;
use Migration\ResourceModel\Source;
use Migration\Config;

class Banner extends AbstractHandler implements HandlerInterface
{

    /**
     * @var Source
     */
    protected $source;

    public function __construct(Config $config, Source $source)
    {
        $this->source = $source;
    }

    public function handle(Record $recordToHandle, Record $oppositeRecord)
    {
        $adapter = $this->source->getAdapter();
        // get banner to placeholder relation
        $query = $adapter->getSelect()
            ->from(
                $this->source->addDocumentPrefix('easybanner_banner_placeholder'),
                ['placeholder_id']
                )
            ->where('banner_id = ?', $recordToHandle->getValue('banner_id'));
        $placeholders = $query->getAdapter()->fetchCol($query);
        // get placeholder mode to determinate banner type in M2
        $mode = 'rotator';
        if (isset($placeholders[0])) {
            $query = $adapter->getSelect()
                ->from(
                    $this->source->addDocumentPrefix('easybanner_placeholder'),
                    ['mode']
                    )
                ->where('placeholder_id = ?', $placeholders[0]);
            $placeholdersMode = $query->getAdapter()->fetchCol($query);
            $mode = isset($placeholdersMode[0]) ? $placeholdersMode[0] : 'rotator';
        }
        switch ($mode) {
            case 'rotator':
                $recordToHandle->setValue($this->field, '1');
                break;

            case 'lightbox':
                $recordToHandle->setValue($this->field, '2');
                break;

            case 'awesomebar':
                $recordToHandle->setValue($this->field, '3');
                break;
        }
    }

}
