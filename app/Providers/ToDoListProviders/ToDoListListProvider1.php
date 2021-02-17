<?php


namespace App\Providers\ToDoListProviders;


use App\Adapters\ToDoListAdapter\ToDoListProvider1Adapter;
use App\Factory\TodoListAdapterFactory;
use App\Models\ToDoListProviderResponseModels\ToDoListApiResponseModel;
use App\Providers\ToDoListProviders\Interfaces\ToDoListProviderInterface;
use App\Utility\ToDoClient;
use Illuminate\Support\Facades\Response;

class ToDoListListProvider1 implements ToDoListProviderInterface
{

    use ToDoClient;

    /** @var ToDoListApiResponseModel $response */
    private $response;

    public function call($method, $baseUrl, $endpoint, $requestBody = null)
    {
        $this->response = $this->callService($method, $baseUrl, $endpoint, $requestBody);
    }

    public function getAdaptedResult()
    {
        $toDoListAdapterFactory = new TodoListAdapterFactory();
        $adaptedData = $toDoListAdapterFactory->adaptData(new ToDoListProvider1Adapter(), $this->response->getResponseBody());
        return $adaptedData;
    }

}
