<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\MediaPhotoController;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
      

        $schedule->command('files:delete-orphaned')->everyFiveMinutes();
        $schedule->command('logs:clean')->daily();

        //manually deleting files:delete-orphaned //php artisan files:delete-orphaned

        
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
