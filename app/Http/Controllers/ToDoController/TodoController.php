<?php

namespace App\Http\Controllers\ToDoController;

use App\Factory\ToDoListFactory;
use App\Http\Controllers\Controller;
use App\Models\AssignedTask;
use App\Models\ProviderAdapterModels\ToDoProviderAdapterModels\ToDoListProviderAdapterModel;
use App\Models\Task;
use App\Models\User;
use App\Providers\ToDoListProviders\ToDoListListProvider1;
use App\Providers\ToDoListProviders\ToDoListListProvider2;
use App\Utility\ToDoClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function showToDoPlan() {

        $tasks = Task::with('user')->get();
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
        // Assign Steps
        // 1. Sort by descending Developer performance.
        // 2. Check developer weekly work hour.
        // 3. Match task level with developer performance and assign.
        // 4. If there is still work left, sort by ascending Developer performance.
        // 5. Do 2. & 3. steps.

        /* Get Developers */
        $developers = User::orderBy('performance', 'DESC')->get();

        $week = 1;
        $weeklyTotalWorkHour = 45;


        do {

            /* Get Tasks */
            $tasks = Task::whereNull('assigned_user_id')->get();

            foreach ($tasks as $task) {

                if (is_null($task->assigned_user_id)) {

                    foreach ($developers as $developer) {

                        /* Developer Assigned Tasks */
                        $assignedTasks = Task::with(['user'])->where([
                            ['assigned_user_id', '=', $developer->id]
                        ])->get();
                        $totalWorkHour = $assignedTasks->sum('estimated_duration');

                        if (($totalWorkHour + $task->estimated_duration) < $weeklyTotalWorkHour && $task->level == $developer->performance) {
                            echo $task->id . ' işini ' . $developer->name. ' YAPABİLİR<br>';
                            $task->assigned_user_id = $developer->id;
                            $task->task_status = 1;
                            $task->save();
                            break;
                        }

                    }

                }

            }


            $weeklyTotalWorkHour *= 2;
            $week++;

        }while(Task::whereNull('assigned_user_id')->count() > 0);
        echo $weeklyTotalWorkHour."<br>";
        echo $week;
    }


}
