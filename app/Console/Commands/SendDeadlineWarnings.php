<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Console\Command;
use App\Notifications\TaskDeadlineWarning;

class SendDeadlineWarnings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-deadline-warnings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send warning emails for tasks with approaching deadlines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $warningTime = Carbon::now()->addHours(24);

        $tasks = Task::where('due_date', '<=', $warningTime)
                     ->where('due_date', '>', Carbon::now())
                     ->get();

        foreach ($tasks as $task) {
            $task->createdBy->notify(new TaskDeadlineWarning($task));
        }

        $this->info('Deadline warning emails sent successfully.');
    }
}
