<?php


namespace App\Factory;


use App\Adapters\ToDoListAdapter\ToDoListAdapterInterface;

class TodoListAdapterFactory
{
    public function adaptData(ToDoListAdapterInterface $toDoListAdapterInterface, $data) {

        $adaptedData = $toDoListAdapterInterface->setDataGetAdaptedData($data);
        return $adaptedData;
    }
}
