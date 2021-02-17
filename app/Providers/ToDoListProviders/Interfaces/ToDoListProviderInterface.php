<?php


namespace App\Providers\ToDoListProviders\Interfaces;


interface ToDoListProviderInterface
{
    public function call($method, $baseUrl, $endpoint, $requestBody = null);
    public function getAdaptedResult();
}
