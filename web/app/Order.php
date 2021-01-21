<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const TRANSACTION_PAYPAL = 'paypal';
    const TRANSACTION_BANK = 'bankcard';
    /**
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'address',
        'phone', 'transaction_type', 'order_total',
        'transaction_data',
    ];

    /**
     * @return array|null
     */
    public function getTransactionPropertiesArrayAttribute(): ?array
    {
        if (!$this->transaction_data) {
            return null;
        }

        return json_decode($this->transaction_data, true);
    }

    /**
     * Relationship to Order Item model
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
