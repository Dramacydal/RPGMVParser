<?php

namespace rp;

use rp\entities\commands\showPictureCommand;
use rp\entities\commonEvent;
use rp\entities\eventPage;
use rp\entities\map;
use rp\entities\mapEvent;

class parser
{
    /** @var commonEvent[] */
    private $commonEvents;

    private $gameDir;

    /** @var map[] */
    private $maps;

    private $mapInfos;

    private $switches;
    private $variables;

    /**
     * @var array
     */
    private $animations;

    function __construct($gameDir)
    {
        $this->gameDir = $gameDir;
        $this->loadCommonEvents();
        $this->loadMapInfos();
        $this->loadMaps();
        $this->loadSystem();
        $this->loadAnimations();
    }

    private function commonEventsFile()
    {
        return $this->gameDir . '/www/data/CommonEvents.json';
    }

    private function getMapFile($mapId)
    {
        return $this->gameDir . '/www/data/Map' . sprintf('%03d', (int)$mapId) . '.json';
    }


    private function loadCommonEvents()
    {
        $this->commonEvents = [];
        $eventsFile = $this->commonEventsFile();
        $wtf = file_get_contents($eventsFile);
        if (empty($wtf)) {
            throw new \Exception("Failed to read events json");
        }

        $wtf = json_decode(trim($wtf), true);
        if (empty($wtf)) {
            throw new \Exception("Empty events json");
        }

        foreach ($wtf as $eventId => $commonEvent) {
            $this->commonEvents[$eventId] = !empty($commonEvent) ?
                new commonEvent($commonEvent, $this) : null;
        }
    }

    private function loadMaps()
    {
        $this->maps = [];
        foreach (array_keys($this->mapInfos) as $mapId) {
            $filePath = $this->getMapFile($mapId);
            if (!is_file($filePath)) {
                echo "Map [{$mapId}] file not found!";
                continue;
            }

            $wtf = file_get_contents($filePath);
            if (empty($wtf)) {
                throw new \Exception("Failed to read map $mapId");
            }

            $wtf = json_decode(trim($wtf), true);
            if (empty($wtf)) {
                throw new \Exception("Failed to decode map $mapId");
            }

            $this->maps[$mapId] = $wtf;
        }

        foreach ($this->maps as $mapId => &$mapData) {
            $mapData = new map($mapData, $this);
            $mapData->setId($mapId);
        }
        unset($mapData);
    }

    function prepareEvent($eventId, $from = 'KiraBust_outfit_lower', $to = 'KiraPenis_1')
    {
        if (empty($this->commonEvents[$eventId]['list'])) {
            echo "Event not found";

            return;
        }

        $commonEvent = &$this->commonEvents[$eventId]['list'];

        foreach ($commonEvent as &$event) {
            if (empty($event['code'])) {
                continue;
            }

            if ($event['code'] != 231)  // show image
            {
                continue;
            }

            $parameters = &$event['parameters'];

            $imageName = $this->convertImageName($parameters[1], $from, $to);

            if ($parameters[1] != $imageName) {
                echo $imageName . PHP_EOL;
                $parameters[1] = $imageName;
            }
        }
        unset($event);
    }

    private function convertImageName($oldName, $from, $to)
    {
        $imageName = str_replace($from, $to, $oldName);
        if (stripos($imageName, 'pregnant_') !== false) {
            $imageName = str_replace('pregnant_', '', $imageName);
            $imageName .= '_preg';
        }
        if (stripos($imageName, 'preg_') !== false) {
            $imageName = str_replace('preg_', '', $imageName);
            $imageName .= '_preg';
        }

        return $imageName;
    }

    public function getImagesToConvert($eventId, $from = 'KiraBust_outfit_lower', $to = 'KiraPenis_1')
    {
        $commonEvent = $this->getCommonEvent($eventId);
        if (!$commonEvent) {
            echo "Event not found";

            return [];
        }

        $skipped = $converted = [];

        foreach ($commonEvent->getCommands() as $command) {
            if (!$command || !$command->getCode()) {
                continue;
            }

            // show image
            if ($command->getCode() != commandCodes::CODE_SHOW_PICTURE) {
                continue;
            }

            /** @var showPictureCommand $command */

            $imageName = $this->convertImageName($command->getPicture(), $from, $to);

            if ($command->getPicture() != $imageName) {
                echo $imageName . PHP_EOL;
                $converted[$command->getPicture()] = $imageName;
            } else {
                $skipped[] = $imageName;
            }
        }

        return [
            'converted' => $converted,
            'skipped' => array_unique($skipped),
        ];
    }

    public function getCommonEvents()
    {
        return $this->commonEvents;
    }

    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * @param int $id
     *
     * @return map|null
     */
    public function getMap(int $id): ?map
    {
        return !empty($this->maps[$id]) ? $this->maps[$id] : null;
    }

    public function saveCommonEvents()
    {
        foreach ($this->commonEvents as $commonEvent) {
            if (!$commonEvent) {
                continue;
            }

            if ($commonEvent->isModified()) {
                file_put_contents($this->commonEventsFile() . '~', json_encode($this->commonEvents));
                echo 'Saved common events' . PHP_EOL;

                return;
            }
        }

        echo 'No common events modified' . PHP_EOL;
    }

    public function saveMaps(bool $modifiedOnly = true)
    {
        foreach ($this->maps as $mapId => $map) {
            if ($modifiedOnly && !$map->isModified()) {
                continue;
            }

            $filePath = $this->getMapFile($mapId);
            if (!is_file($filePath)) {
                echo "Map id #$mapId to save not found" . PHP_EOL;
            }

            file_put_contents($filePath . '~', json_encode($map->getData()));
            echo "Saved map #{$mapId}" . PHP_EOL;
        }
    }

    public function walk(walkCallback $callback)
    {
        if ($callback->commonEventCommandCallback || $callback->commonEventCallback) {
            foreach ($this->commonEvents as $cCommonEvent) {
                if (!$cCommonEvent) {
                    continue;
                }

                if ($callback->commonEventCommandCallback) {
                    foreach ($cCommonEvent->getCommands() as $index => $command) {
                        if (!$command) {
                            continue;
                        }

                        $result = call_user_func($callback->commonEventCommandCallback, $index, $command, $cCommonEvent);
                        if ($command->isModified()) {
                            if (!is_array($command->getData())) {
                                echo "Bad result while walking " . __LINE__ . PHP_EOL;

                                return;
                            }
                        }

                        if (!$result) {
                            break 2;
                        }
                    }
                }

                if ($callback->commonEventCallback) {
                    $result = call_user_func($callback->commonEventCallback, $cCommonEvent);
                    if ($cCommonEvent->isModified()) {
                        if (!is_array($cCommonEvent->getData())) {
                            echo "Bad result while walking " . __LINE__ . PHP_EOL;

                            return;
                        }
                    }

                    if (!$result) {
                        break;
                    }
                }
            }
        }

        if ($callback->mapEventPageCommandCallback || $callback->mapEventPageCallback) {
            foreach ($this->maps as $mapId => $mapData) {
                foreach ($mapData->getEvents() as $mapEventId => $mapEvent) {
                    if (!$mapEvent) {
                        continue;
                    }

                    foreach ($mapEvent->getPages() as $cPage) {
                        if (!$cPage) {
                            continue;
                        }

                        if ($callback->mapEventPageCommandCallback) {
                            foreach ($cPage->getCommands() as $index => $command) {
                                if (!$command) {
                                    continue;
                                }

                                $result = call_user_func($callback->mapEventPageCommandCallback, $index, $command, $cPage);
                                if ($command->isModified()) {
                                    if (!is_array($command->getData())) {
                                        echo "Bad result while walking " . __LINE__ . PHP_EOL;

                                        return;
                                    }
                                }

                                if (!$result) {
                                    break 4;
                                }
                            }
                        }

                        if ($callback->mapEventPageCallback) {
                            $result = call_user_func($callback->mapEventPageCallback, $cPage);
                            if ($cPage->isModified()) {
                                if (!is_array($cPage->getData())) {
                                    echo "Bad result while walking " . __LINE__ . PHP_EOL;

                                    return;
                                }
                            }

                            if (!$result) {
                                break 3;
                            }
                        }
                    }
                }
            }
        }
    }

    public function getImageFile($imageName, $extension = '.png')
    {
        static $files = [];
        if (empty($files)) {
            $files = scandir($this->gameDir . '/www/img/pictures');
        }

        foreach ($files as $file) {
            if (strtolower($file) == strtolower($imageName) . $extension) {
                return $this->gameDir . '/www/img/pictures/' . $file;
            }
        }

        return false;
    }

    private function loadMapInfos()
    {
        $this->mapInfos = [];

        $filePath = $this->gameDir . '/www/data/MapInfos.json';
        if (!is_file($filePath)) {
            throw new \Exception("Mapinfo file not found");
        }

        $wtf = file_get_contents($filePath);
        if (empty($wtf)) {
            throw new \Exception("Failed to read mapinfo");
        }

        $wtf = json_decode(trim($wtf), true);
        if (empty($wtf)) {
            throw new \Exception("Failed to decode mapinfo");
        }

        foreach ($wtf as $row) {
            if (empty($row['id'])) {
                continue;
            }

            $this->mapInfos[$row['id']] = $row;
        }
    }

    public function getMapInfo(int $mapId): array
    {
        return $this->mapInfos[$mapId] ?? [];
    }

    /**
     * @param int $mapId
     * @param int $eventId
     * @param int $pageId
     *
     * @return eventPage|null
     */
    public function getMapEventPage(int $mapId, int $eventId, int $pageId): ?eventPage
    {
        $mapEvent = $this->getMapEvent($mapId, $eventId);
        if (!$mapEvent)
            return null;

        return $mapEvent->getPage($pageId);
    }

    /**
     * @param int $mapId
     * @param int $eventId
     *
     * @return mapEvent|null
     */
    public function getMapEvent(int $mapId, int $eventId): ?mapEvent
    {
        $map = $this->getMap($mapId);
        if (!$map)
            return null;

        return $map->getEvent($eventId);
    }

    public function getCommonEvent(int $commonEventId): ?commonEvent
    {
        if (empty($this->commonEvents[$commonEventId])) {
            return null;
        }

        return $this->commonEvents[$commonEventId];
    }

    private function loadSystem()
    {
        $filePath = $this->gameDir . '/www/data/System.json';
        if (!is_file($filePath)) {
            throw new \Exception("System file not found");
        }

        $wtf = file_get_contents($filePath);
        if (empty($wtf)) {
            throw new \Exception("Failed to load system");
        }

        $wtf = json_decode(trim($wtf), true);
        if (empty($wtf)) {
            throw new \Exception("Failed to decode system");
        }

        $this->switches = $wtf['switches'] ?? [];
        $this->variables = $wtf['variables'] ?? [];
    }

    public function getSwitch(int $switchId): ?string
    {
        return $this->switches[$switchId] ?? null;
    }

    public function getVariable(int $variableId): ?string
    {
        return $this->variables[$variableId] ?? null;
    }

    public function getGameDirectory(): string
    {
        return $this->gameDir;
    }

    private function loadAnimations()
    {
        $this->animations = [];
        $filePath = $this->gameDir . '/www/data/Animations.json';
        if (!is_file($filePath)) {
            throw new \Exception("Animations file not found");
        }

        $wtf = file_get_contents($filePath);
        if (empty($wtf)) {
            throw new \Exception("Failed to load animations");
        }

        $wtf = json_decode(trim($wtf), true);
        if (empty($wtf)) {
            throw new \Exception("Failed to decode animations");
        }

        $this->animations = $wtf;
    }

    public function getAnimation($id)
    {
        return !empty($this->animations[$id]) ? $this->animations[$id] : null;
    }
}
