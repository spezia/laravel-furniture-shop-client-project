<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasTranslations, HasTranslatableSlug, InteractsWithMedia, SoftDeletes;

    public $translatable = ['name', 'slug', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_enabled', 'category_id',
        'description', 'price',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Register media collection
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(\config('custom.media.product'))
            ->useDisk(\config('custom.media.product'))
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
            });
    }

    /**
     * Use image from collection
     *
     * @param boolean $thumb
     * 
     * @return string
     */
    public function fetchSingleImage($thumb = false): string
    {
        $media = $this->getMedia(\config('custom.media.product'))->first();

        return $thumb ? $media->getUrl('thumb') : $media->getUrl();
    }

    /**
     * Relationship to category model
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship to review model
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
