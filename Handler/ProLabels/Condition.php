<?php

namespace Swissup\DataMigration\Handler\ProLabels;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;

class Condition extends AbstractHandler implements HandlerInterface
{


    /**
     * [handle description]
     * @param  Record $recordToHandle destination record (in this case)
     * @param  Record $oppositeRecord source record (in this case)
     */
    public function handle(Record $recordToHandle, Record $oppositeRecord)
    {
        $condition = unserialize($recordToHandle->getValue($this->field));
        $condition = $this->transform($condition);
        $recordToHandle->setValue($this->field, serialize($condition));
    }

    public function transform($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_string($key) && $key == 'type') {
                    $classArr = explode('/', trim($value));
                    if (isset($classArr[0]) && $classArr[0] == 'prolabels') {
                        $classArr[0] = 'Magento\CatalogRule\Model';
                    }
                    if (isset($classArr[1])) {
                        $trail = explode('_', $classArr[1]);
                        $trail = array_map('ucfirst', $trail);
                        $classArr[1] = implode('\\', $trail);
                    }
                    $array[$key] = implode('\\', $classArr);
                } else {
                    $array[$key] = $this->transform($value);
                }
            }
        }
        return $array;
    }

}
