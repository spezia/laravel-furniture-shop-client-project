<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasTranslatableSlug;

/**
 * IT IS NOT USED FOR NOW
 */
class Page extends Model
{
    use HasTranslations, HasTranslatableSlug, SoftDeletes;

    public $translatable = ['title', 'content', 'slug'];

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'is_enabled'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
