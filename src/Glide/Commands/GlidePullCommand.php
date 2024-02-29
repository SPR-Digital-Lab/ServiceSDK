<?php

namespace SPR\ServiceSDK\Glide\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GlidePullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glide:pull {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull file to Glide';

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
        $file = $this->argument('file');

        if ($file) {
            $remoteFolder = '/' . $file . '.blade.php';

             $localFolder = base_path('glide/');

            if (!file_exists($localFolder)) {
                mkdir($localFolder, 0777, true);
            }

            if (Storage::disk('glide_ftp')->exists($remoteFolder)) {

                $contents = Storage::disk('glide_ftp')->get($remoteFolder);
                $localFilePath = $localFolder . $file . '.blade.php';

                if (!file_exists($localFilePath)) {
                    mkdir(dirname($localFilePath), 0755, true);
                }
                file_put_contents($localFilePath, $contents);
                $this->info('File downloaded successfully.');

            } else {
                $this->info('File does not exists on FTP server.');
            }
        } else {
            $remoteFolder = '/';
            $localBaseFolder = base_path('glide/');
        
            if (!file_exists($localBaseFolder)) {
                mkdir($localBaseFolder, 0777, true);
            }
        
            $files = Storage::disk('glide_ftp')->allFiles($remoteFolder);
        
            foreach ($files as $file) {
                $remoteFilePath = dirname($file); 
                $localFolderPath = $localBaseFolder . '/' . $remoteFilePath;
                $localFilePath = $localBaseFolder . '/' . $file;
        
                if (!file_exists($localFolderPath)) {
                    mkdir($localFolderPath, 0777, true); 
                }
        
                $contents = Storage::disk('glide_ftp')->get($file);
                file_put_contents($localFilePath, $contents);
            }
        
            $this->info('Folder downloaded successfully.');
        }
    }
}
