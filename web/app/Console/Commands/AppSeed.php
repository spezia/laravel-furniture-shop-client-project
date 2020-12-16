<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AppSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute (migrate:fresh, seed, generate passport, remove media) only on dev env';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        if (env('APP_ENV') !== 'prod') {
            if (Schema::hasTable('media')) {
                foreach (Media::all() as $media) {
                    $media->delete();
                }
            }

            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
        }
    }
}
