<?php


namespace App\Factory;


interface ToDoListFactoryInterface
{
    public function runProvider(ToDoListFactoryInterface $toDoListFactoryInterface, $method, $baseUrl, $endpoint, $requestBody = null);
}
