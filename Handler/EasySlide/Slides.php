<?php

namespace Swissup\DataMigration\Handler\EasySlide;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;

class Slides extends AbstractHandler implements HandlerInterface
{

    /**
     * [handle description]
     * @param  Record $recordToHandle destination record (in this case)
     * @param  Record $oppositeRecord source record (in this case)
     */
    public function handle(Record $recordToHandle, Record $oppositeRecord)
    {
        $target_mode = $recordToHandle->getValue('title');
        $recordToHandle->setValue('title', $recordToHandle->getValue('image'));
        $recordToHandle->setValue('image', $recordToHandle->getValue('url'));
        $recordToHandle->setValue('url', $recordToHandle->getValue('target'));
        $recordToHandle->setValue('target', $target_mode);
    }

}
