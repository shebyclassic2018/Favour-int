<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Services\UploadDownloadFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Properties\TemporaryFile;

class UnityAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unity:availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check the vailability of Unity every Day.';

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
        echo "This command will check the vailability of Unity every Day.";
        $created =  TemporaryFile::create(['folder' => Str::random(10), 'filename' => Str::random(16) . '.webp']);
        if ($created->id > 0) {
            $temporaryFiles = TemporaryFile::where('created_at', '<=', Carbon::now()->subMinutes(2)->toDateTimeString())->get();
        }

        $temporaryFiles = TemporaryFile::where('created_at', '<=', Carbon::now()->subMinutes(2)->toDateTimeString())->get();
        if ($temporaryFiles->count() > 0) {

            $uploadDownloadFile = new UploadDownloadFile;

            foreach ($temporaryFiles as $temporaryFile) {
                $file_path = env('HOUSE_REPO') . 'houses/' . $temporaryFile->fileName;
                if (Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }

                $uploadDownloadFile->HandleDestroyRecord($temporaryFile);
                // echo $file_path . '\rn';
            }
        }

        echo 'This command will check the vailability of Unity every Day.';

    }
}
