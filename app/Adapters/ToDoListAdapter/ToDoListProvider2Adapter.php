<?php


namespace App\Adapters\ToDoListAdapter;


use App\Models\ProviderAdapterModels\ToDoProviderAdapterModels\ToDoListProviderAdapterModel;

class ToDoListProvider2Adapter implements ToDoListAdapterInterface
{
    public function setDataGetAdaptedData($data)
    {
        $adaptedData = [];

        foreach ($data as $datum) {
            $taskAttributes = reset($datum);

            $adapterModel = new ToDoListProviderAdapterModel();
            $adapterModel->setLevel($taskAttributes->level);
            $adapterModel->setEstimatedDuration($taskAttributes->estimated_duration);
            $adapterModel->setTask(key($datum));

            $adaptedData[] = $adapterModel;
        }
        return $adaptedData;
    }
}
