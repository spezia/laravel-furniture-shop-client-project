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
        'product', 'firstname', 'lastname',
        'email', 'status', 'message'
    ];

    /**
     * @var array
     */
    protected $visible = [
        'id',  'product', 'firstname', 'lastname',
        'email', 'status', 'message'
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
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Relationship to restaurant model
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
