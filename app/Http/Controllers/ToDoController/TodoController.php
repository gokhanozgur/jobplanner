<?php

namespace App\Http\Controllers\ToDoController;

use App\Factory\ToDoListFactory;
use App\Http\Controllers\Controller;
use App\Models\ProviderAdapterModels\ToDoProviderAdapterModels\ToDoListProviderAdapterModel;
use App\Models\Task;
use App\Providers\ToDoListProviders\ToDoListListProvider1;
use App\Providers\ToDoListProviders\ToDoListListProvider2;
use App\Utility\ToDoClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function createToDoPlan() {

        $toDoFactory = new ToDoListFactory();
        $toDoProvider1 = $toDoFactory->runProvider(new ToDoListListProvider1(), 'GET', 'http://www.mocky.io', '/v2/5d47f24c330000623fa3ebfa');
        $toDoProvider2 = $toDoFactory->runProvider(new ToDoListListProvider2(), 'GET', 'http://www.mocky.io', '/v2/5d47f235330000623fa3ebf7');

        //return view("to-do-list", compact('toDoProvider1', 'toDoProvider2'));

    }

    public function saveTasksToDB() {

        $toDoFactory = new ToDoListFactory();
        $toDoProvider1 = $toDoFactory->runProvider(new ToDoListListProvider1(), 'GET', 'http://www.mocky.io', '/v2/5d47f24c330000623fa3ebfa');
        $toDoProvider2 = $toDoFactory->runProvider(new ToDoListListProvider2(), 'GET', 'http://www.mocky.io', '/v2/5d47f235330000623fa3ebf7');

        foreach ($toDoProvider1 as $provider1) {
            $task = new Task();
            $task->task = $provider1->task;
            $task->level = $provider1->level;
            $task->estimated_duration = $provider1->estimated_duration;

            try {
                if ($task->save()) {
                    echo $task->task . '-> Succesfully added to database.';
                }
                else {
                    echo $task->task . '-> Failed.';
                }
            }
            catch (\Exception $exception) {
                Log::alert($exception);
            }

        }

    }
}
