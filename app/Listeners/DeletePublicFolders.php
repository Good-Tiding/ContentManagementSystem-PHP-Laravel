<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DeletePublicFolders
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
           // Check if the migration command is 'migrate:rollback' or 'migrate:refresh'
           if ($event->method === 'up' || $event->method === 'down') {
            $folders = ['uploaded_pic', 'users_profile_pic','storage/images']; // Add the paths to the folders you want to delete

            foreach ($folders as $folder) {
                $folderPath = public_path($folder);
               // Log::info("folderPath file: " .  $folderPath);
               // Log::info("folderPath file: " .  $folder);    
                if (File::isDirectory($folderPath)) {
                    File::deleteDirectory($folderPath);
                }
            }
        }
    } }

