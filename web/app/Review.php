<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    const STATUS_ACCEPTED = 'accepted';
    const STATUS_IN_REVIEW = 'in_review';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'email', 'status', 'comment'
    ];

    /**
     * @var array
     */
    protected $visible = [
        'id',  'product', 'name', 'email', 'status', 'comment'
    ];

    /**
     *
     * @return array
     */
    static public function getStatuses(): array
    {
        return [Review::STATUS_ACCEPTED, Review::STATUS_IN_REVIEW];
    }

    /**
     * Relationship to restaurant model
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
