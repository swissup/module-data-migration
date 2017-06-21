<?php

namespace Swissup\DataMigration\Handler\EasySlide;

use Migration\Handler\AbstractHandler;
use Migration\Handler\HandlerInterface;
use Migration\ResourceModel\Record;
use Migration\ResourceModel\Source;
use Migration\Config;

class Slider extends AbstractHandler implements HandlerInterface
{

    /**
     * @var Source
     */
    protected $source;

    public function __construct(Config $config, Source $source)
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

        // get related slider data  from source
        $query = $adapter->getSelect()
            ->from(
                $this->source->addDocumentPrefix('easyslide'),
                ['theme', 'duration', 'controls_type', 'frequency', 'effect']
                )
            ->where('easyslide_id = ?', $recordToHandle->getValue('slider_id'));

        $data = $query->getAdapter()->fetchRow($query);

        $theme = $data['theme'];
        switch ($theme) {
            case 'light':
                $theme = 'white';
                break;
            case 'dark':
                $theme = 'black';
                break;
            default:
                $theme = 'default';
                break;
        }
        $speed = $data['duration'] * 1000;
        $pagination = ($data['controls_type'] == 'number') ? '1' : '0';
        $navigation = ($data['controls_type'] == 'arrow') ? '1' : '0';
        $autoplay = $data['frequency'] * 1000;
        $effect = $data['effect'];
        $sliderConfig = [
            'theme' => $theme,
            'direction' => 'horizontal',
            'speed' => $speed,
            'pagination' => $pagination,
            'navigation' => $navigation,
            'scrollbar' => '0',
            'scrollbarHide' => '0',
            'autoplay' => $autoplay,
            'effect' => $effect
        ];

        $recordToHandle->setValue($this->field, serialize($sliderConfig));
    }

}
