<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperSession
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type_id',
        'partnership_id',
        'user_id',
        'description',
        'address',
        'amount',
        'status_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function partnership(): BelongsTo
    {
        return $this->belongsTo(Partnership::class, 'partnership_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(OrderType::class, 'type_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(
            Worker::class,
            'order_worker',
            'order_id',
            'worker_id',
            'id',
            'id'
        );
    }
}
