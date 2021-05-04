<?php

namespace rp\entities;

abstract class abstractCommandContainer extends abstractEntity
{
    /**
     * @return abstractCommand[]|\Generator
     */
    public function getCommands(): \Generator
    {
        if (empty($this->data['list'])) {
            return;
        }

        foreach (array_keys($this->data['list']) as $commandIndex) {
            yield $commandIndex => $this->getCommandByIndex($commandIndex);
        }
    }

    /**
     * @param abstractCommand[] $commandList
     */
    public function setCommands(array $commandList)
    {
        $this->data['list'] = $commandList;
        $this->setIsModified(true);
    }

    /**
     * @param int $index
     *
     * @return abstractEntity|null
     */
    public function getCommandByIndex(int $index): ?abstractEntity
    {
        $command = !empty($this->data['list'][$index]) ? $this->data['list'][$index] : null;
        if (is_array($command)) {
            $command = abstractCommand::factory($command, $this->getP());
            $command->setContainer($this);

            $this->data['list'][$index] = $command;
        }

        return $command;
    }

    public function hasCommands(): bool
    {
        return !empty($this->data['list']);
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return implode(PHP_EOL, array_map(function (abstractCommand $command) {
            return $command->asString(true);
        }, iterator_to_array($this->getCommands())));
    }
}
