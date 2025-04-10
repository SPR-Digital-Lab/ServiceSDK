<?php

namespace SPR\ServiceSDK\Glide\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GlidePushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glide:push {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push file to Glide';

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
            $localFilePath = base_path('glide/' . $file . '.blade.php');
            if (!file_exists($localFilePath)) {
                $this->error("File '$file' does not exist locally.");
                return;
            }

            if (pathinfo($localFilePath, PATHINFO_EXTENSION) !== 'php') {
                $this->error("File '$file' is not a PHP file. Only PHP files can be pushed to FTP.");
                return;
            }

            try {
                $contents = file_get_contents($localFilePath);
                if ($contents !== false) {
                    $remoteFilePath = '/' . $file;

                    $directory = dirname($remoteFilePath);
                    Storage::disk('glide_ftp')->makeDirectory($directory, 0755, true);

                    Storage::disk('glide_ftp')->put($remoteFilePath . '.blade.php', $contents);

                    $this->info("File '$file' pushed to FTP server.");
                } else {
                    $this->error("Failed to read contents of file '$file'.");
                }
            } catch (\Exception $e) {
                $this->error("Error occurred while processing file '$file': " . $e->getMessage());
            }
            
        } else {
            $localFolder = base_path('glide');
            $files = scandir($localFolder);

            foreach ($files as $file) {
                $filePath = $localFolder . '/' . $file;

                if (pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
                    try {
                        $contents = file_get_contents($filePath);
                        if ($contents !== false) {
                            $remoteFilePath = '/' . basename($filePath);
                            Storage::disk('glide_ftp')->put($remoteFilePath, $contents);
                            $this->info("File '$file' pushed to FTP server.");
                        } else {
                            $this->error("Failed to read contents of file '$file'.");
                        }
                    } catch (\Exception $e) {
                        $this->error("Error occurred while processing file '$file': " . $e->getMessage());
                    }
                }
            }

            $this->info('Pushed all edited files to FTP server.');
        }
    }
}
