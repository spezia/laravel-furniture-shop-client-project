<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDiscount extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'product_id', 'new_price', 'discount',
        'from', 'to',
    ];

    /**
     * @var array
     */
    protected $visible = [
        'id',  'product', 'new_price', 'discount',
        'from', 'to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'from' => 'datetime:d.m.Y',
        'to' => 'datetime:d.m.Y',
    ];

    protected $with = ['product'];

    /**
     * Check if product has valid discount action
     *
     * @return bool
     */
    public function getIsActiveAttribute(): bool
    {
        $currentDate = now();

        if ($this->from <= $currentDate && $this->to >= $currentDate) {
            return true;
        }

        return false;
    }

    /**
     * Relationship to restaurant model
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
