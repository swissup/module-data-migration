<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Swissup\DataMigration\Handler\AskIt;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;

/**
 * Handler to set constant value to the field
 */
class NullToZero extends AbstractHandler implements HandlerInterface
{

    /**
     * {@inheritdoc}
     */
    public function handle(Record $recordToHandle, Record $oppositeRecord)
    {
        $this->validate($recordToHandle);
        $value = $recordToHandle->getValue($this->field);
        if ($value === NULL) {
            $recordToHandle->setValue($this->field, '0');
        }
    }
}
