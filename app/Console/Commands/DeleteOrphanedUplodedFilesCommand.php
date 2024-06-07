<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UploadPhoto;
use App\Models\Photo;
use App\Models\User;

class DeleteOrphanedUplodedFilesCommand extends Command
{

    protected $signature = 'files:delete-orphaned';
    protected $description = 'Deletes orphaned files from the database' ;
    public function handle()
    {
        $this->deleteOrphanedFiles(UploadPhoto::class,'uploaded_pic');
      //  $this->deleteOrphanedFiles(Photo::class,'users_profile_pic');
    }

     public function deleteOrphanedFiles($model,$folder)
    {
        // Check if the  folder exists
        if (!file_exists(public_path($folder))) 
        {
            // The folder does not exist, so delete all photo records
            $model::query()->delete();
           
        } 
        else 
        {
            // The folder exists, check each file
            $photos = $model::all();
            foreach ($photos as $photo) 
            {
                if (!file_exists(public_path(). $photo->file)) 
                {
                    
                    
                    // The individual photo file does not exist, so delete the record
                    $photo->delete();

                  
                }
            }
           // $this->info('Uploaded orphaned files deleted successfully.');
        }
    }
}
