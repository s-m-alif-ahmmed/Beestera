<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Vimeo\Laravel\Facades\Vimeo;

class CheckVimeoVideoStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $taskId;

    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }

    public function handle(): void
    {
        $task = Task::find($this->taskId);

        if (!$task || $task->status === 'active' || $task->status === 'inactive') {
            return;
        }

        $allProcessed = true;

        // Check each video if it exists
        if ($task->base_video) {
            $response = Vimeo::request('/videos/' . $task->base_video, [], 'GET');
            if ($response['body']['status'] !== 'available') {
                $allProcessed = false;
            }
        }
        if ($task->boost_video) {
            $response = Vimeo::request('/videos/' . $task->boost_video, [], 'GET');
            if ($response['body']['status'] !== 'available') {
                $allProcessed = false;
            }
        }
        if ($task->build_video) {
            $response = Vimeo::request('/videos/' . $task->build_video, [], 'GET');
            if ($response['body']['status'] !== 'available') {
                $allProcessed = false;
            }
        }

        if ($allProcessed) {
            $task->status = 'active';
            $task->save();
        } else {
            self::dispatch($this->taskId)->delay(now()->addMinute());
        }
    }
}
