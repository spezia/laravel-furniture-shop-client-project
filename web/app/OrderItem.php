<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'total', 'product_id',
        'quantity', 'properties', 'order_id'
    ];

    /**
     * @return array|null
     */
    public function getPropertiesArrayAttribute(): ?array
    {
        if (!$this->properties) {
            return null;
        }

        return json_decode($this->properties, true);
    }

    /**
     * Relationship to Product model
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship to Order model
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
