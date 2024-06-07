<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CleanOldLogs extends Command
{
    protected $signature = 'logs:clean';
    protected $description = 'Clean old Laravel logs';

    public function handle()
{
    $logFilePath = storage_path('logs/laravel.log');
    $sevenDaysAgo = now()->subDays(5)->timestamp;

    if (file_exists($logFilePath)) {
        $logContent = file_get_contents($logFilePath);
        $lines = explode("\n", $logContent);

        $filteredLines = array_filter($lines, function ($line) use ($sevenDaysAgo) {
            // Check if the log entry timestamp is older than 7 days
            return preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $line, $matches)
                && strtotime(substr($matches[0], 1, -1)) >= $sevenDaysAgo;
        });

        file_put_contents($logFilePath, implode("\n", $filteredLines));
    }
}

}
