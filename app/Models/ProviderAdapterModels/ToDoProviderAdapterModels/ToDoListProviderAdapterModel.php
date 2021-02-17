<?php


namespace App\Models\ProviderAdapterModels\ToDoProviderAdapterModels;


class ToDoListProviderAdapterModel
{
    private $task;
    private $level;
    private $estimatedDuration;

    /*private $keyMap = [
        'zorluk' => 'level',
        'sure' => 'estimatedDuration',
        'id' => 'task',
    ];*/

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task): void
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDuration()
    {
        return $this->estimatedDuration;
    }

    /**
     * @param mixed $estimatedDuration
     */
    public function setEstimatedDuration($estimatedDuration): void
    {
        $this->estimatedDuration = $estimatedDuration;
    }

}
