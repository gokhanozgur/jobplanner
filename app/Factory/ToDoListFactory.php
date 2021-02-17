<?php


namespace App\Factory;


use App\Providers\ToDoListProviders\Interfaces\ToDoListProviderInterface;

class ToDoListFactory
{
    public function runProvider(ToDoListProviderInterface $toDoListProviderInterface, $method, $baseUrl, $endpoint, $requestBody = null) {

        /* Call comes provider and return response. */
        $toDoListProviderInterface->call($method, $baseUrl, $endpoint, $requestBody);
        $providerResponse = $toDoListProviderInterface->getAdaptedResult();
        return $providerResponse;

    }
}
