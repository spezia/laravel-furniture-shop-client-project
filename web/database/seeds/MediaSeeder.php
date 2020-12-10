<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Delete media and files.
 */
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds always as first to clean table and disk storage
     *
     * @return void
     */
    public function run()
    {
        // delete entries in media table and all files from disk
        if (env('APP_ENV') !== 'prod') {
            foreach (Media::all() as $media) {
                $media->delete();
            }
        }
    }
}
