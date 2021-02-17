<?php

namespace App\Http\Controllers\ToDoController;

use App\Factory\ToDoListFactory;
use App\Http\Controllers\Controller;
use App\Providers\ToDoListProviders\ToDoListListProvider1;
use App\Providers\ToDoListProviders\ToDoListListProvider2;
use App\Utility\ToDoClient;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function createToDoPlan() {

        $toDoFactory = new ToDoListFactory();
        $toDoProvider1 = $toDoFactory->runProvider(new ToDoListListProvider1(), 'GET', 'http://www.mocky.io', '/v2/5d47f24c330000623fa3ebfa');
        $toDoProvider2 = $toDoFactory->runProvider(new ToDoListListProvider2(), 'GET', 'http://www.mocky.io', '/v2/5d47f235330000623fa3ebf7');

    }
}
