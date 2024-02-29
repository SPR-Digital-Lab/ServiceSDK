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
            $localFolder = base_path('glide/');

            if (!file_exists($localFolder)) {
                mkdir($localFolder, 0777, true);
            }

            $files = Storage::disk('glide_ftp')->allFiles($remoteFolder);

            $phpFiles = array_filter($files, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'php';
            });

            foreach ($phpFiles as $file) {
                $contents = Storage::disk('glide_ftp')->get($file);
                $localFilePath = $localFolder . '/' . basename($file);
                file_put_contents($localFilePath, $contents);
            }
            $this->info('Folder downloaded successfully.');
        }
    }
}
