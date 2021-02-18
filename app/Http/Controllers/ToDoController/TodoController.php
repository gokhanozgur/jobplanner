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
    public function showToDoPlan() {

        $tasks = Task::all();
        return view("to-do-list", compact('tasks'));

    }

    public function saveTasksToDB() {

        /* For Web UI */

        $toDoFactory = new ToDoListFactory();
        $toDoProvider1 = $toDoFactory->runProvider(new ToDoListListProvider1(), 'GET', 'http://www.mocky.io', '/v2/5d47f24c330000623fa3ebfa');
        $toDoProvider2 = $toDoFactory->runProvider(new ToDoListListProvider2(), 'GET', 'http://www.mocky.io', '/v2/5d47f235330000623fa3ebf7');

        $mergedProviderData = array_merge($toDoProvider1, $toDoProvider2);

        /** @var ToDoListProviderAdapterModel $provider1 */
        foreach ($mergedProviderData as $provider1) {
            $task = new Task();
            $task->task = $provider1->getTask();
            $task->level = $provider1->getLevel();
            $task->estimated_duration = $provider1->getEstimatedDuration();

            try {
                if ($task->save()) {
                    echo $task->task . '-> Succesfully added to database.<br>';
                }
                else {
                    echo $task->task . '-> Failed.<br>';
                }
            }
            catch (\Exception $exception) {
                Log::alert($exception);
            }

        }

    }

    public function createToDoPlan() {
        // Assign task codes here...
    }

}
