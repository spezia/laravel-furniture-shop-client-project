<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations, HasTranslatableSlug, InteractsWithMedia, SoftDeletes;

    public $translatable = ['name', 'slug', 'description', 'properties'];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'is_enabled', 'category_id',
        'description', 'price', 'code', 'properties',
    ];

    /**
     * @var array
     */
    protected $appends = ['single_image', 'properties_array'];

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
     * @return string|null
     */
    public function getSingleImageAttribute(): ?string
    {
        if (!$media = $this->getMedia(\config('custom.media.product'))->first()) {
            return null;
        }

        return $media->getUrl();
    }

    /**
     * Use image from collection
     *
     * @return string|null
     */
    public function getSingleImageSmallAttribute(): ?string
    {
        if (!$media = $this->getMedia(\config('custom.media.product'))->first()) {
            return null;
        }

        return $media->getUrl('thumb');
    }

    /**
     * Set up discount new price in product (need for sorting, etc...)
     * and remove useless zero digits from decimals
     *
     * @return float
     */
    public function getNewPriceAttribute(): float
    {
        if ($this->discounts->count() > 0 && $discount = $this->discounts->where('is_active', true)) {
            return $discount->first()->new_price;
        }

        return $this->price;
    }

    /**
     * @return array|null
     */
    public function getPropertiesArrayAttribute(): ?array
    {
        $response = [];

        if (!$this->properties) {
            return null;
        }

        foreach (explode(',', $this->properties) as $key => $property) {
            if ($property) {
                $array = explode(':', $property);
                $label = ucfirst(trim($array[0]));
                $value = trim($array[1]);
                $response[$key] = [$label, $value];
            }
        }

        return $response;
    }

    /**
     * Relationship to category model
     */
    public function category(): BelongsTo
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

    /**
     * Relationship to discount model
     */
    public function discounts(): HasMany
    {
        return $this->hasMany(ProductDiscount::class);
    }
}
