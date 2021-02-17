<?php


namespace App\Adapters\ToDoListAdapter;


use App\Models\ProviderAdapterModels\ToDoProviderAdapterModels\ToDoListProviderAdapterModel;

class ToDoListProvider1Adapter implements ToDoListAdapterInterface
{
    public function setDataGetAdaptedData($data)
    {
        $adaptedData = [];

        foreach ($data as $datum) {
            $adapterModel = new ToDoListProviderAdapterModel();
            $adapterModel->setLevel($datum->zorluk);
            $adapterModel->setEstimatedDuration($datum->sure);
            $adapterModel->setTask($datum->id);

            $adaptedData[] = $adapterModel;
        }

        return $adaptedData;
    }
}
