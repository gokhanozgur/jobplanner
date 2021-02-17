<?php


namespace App\Providers\ToDoListProviders;


use App\Adapters\ToDoListAdapter\ToDoListProvider2Adapter;
use App\Factory\TodoListAdapterFactory;
use App\Providers\ToDoListProviders\Interfaces\ToDoListProviderInterface;
use App\Utility\ToDoClient;
use Illuminate\Support\Facades\Response;

class ToDoListListProvider2 implements ToDoListProviderInterface
{
    use ToDoClient;

    private $response;

    public function call($method, $baseUrl, $endpoint, $requestBody = null)
    {
        $this->response = $this->callService($method, $baseUrl, $endpoint, $requestBody);
    }

    public function getAdaptedResult()
    {
        $toDoListAdapterFactory = new TodoListAdapterFactory();
        $adaptedData = $toDoListAdapterFactory->adaptData(new ToDoListProvider2Adapter(), $this->response->getResponseBody());
        return $adaptedData;
    }
}
