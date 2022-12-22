<?php

namespace PleskExtLaravel\Console\Commands;

use Illuminate\Queue\Console\ListFailedCommand;

class QueueFailedCommand extends ListFailedCommand
{
    protected $signature = 'plesk-ext-laravel:queue-failed';

    protected $description = 'List all of the failed queue jobs';

    public function handle()
    {
        $jobs = $this->getFailedJobs();
        $output = collect($jobs)->map(fn($job) => [
            'uuid' => $job[0],
            'connection' => $job[1],
            'queue' => $job[2],
            'job' => $job[3],
            'date' => $job[4],
        ])->toJson();
        $this->output->write($output);
    }
}
