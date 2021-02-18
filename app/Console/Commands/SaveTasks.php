<?php

namespace App\Console\Commands;

use App\Factory\ToDoListFactory;
use App\Models\ProviderAdapterModels\ToDoProviderAdapterModels\ToDoListProviderAdapterModel;
use App\Models\Task;
use App\Providers\ToDoListProviders\ToDoListListProvider1;
use App\Providers\ToDoListProviders\ToDoListListProvider2;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SaveTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tasks from providers and save to database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* For Console Command */

        $toDoFactory = new ToDoListFactory();
        $toDoProvider1 = $toDoFactory->runProvider(new ToDoListListProvider1(), 'GET', 'http://www.mocky.io', '/v2/5d47f24c330000623fa3ebfa');
        $toDoProvider2 = $toDoFactory->runProvider(new ToDoListListProvider2(), 'GET', 'http://www.mocky.io', '/v2/5d47f235330000623fa3ebf7');

        $mergedProviderData = array_merge($toDoProvider1, $toDoProvider2);

        $this->info('Data saving to database...');

        /** @var ToDoListProviderAdapterModel $providerData */
        foreach ($mergedProviderData as $key => $providerData) {
            ++$key;
            $main = $this->output->createProgressBar(100);
            $task = new Task();
            $task->task = $providerData->getTask();
            $task->level = $providerData->getLevel();
            $task->estimated_duration = $providerData->getEstimatedDuration();

            try {
                if ($task->save()) {
                    $this->info($key . '. ' . $task->task . ' -> Successfully added to database.');
                }
                else {
                    $this->alert($key . '. ' . $task->task . ' -> Failed.');
                }
            }
            catch (\Exception $exception) {
                Log::alert($exception);
            }
        }
        $main->finish();
        $this->info(' Done.');
    }
}
