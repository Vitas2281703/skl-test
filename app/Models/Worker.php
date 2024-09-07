<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperSession
 */
class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'surname',
        'phone',
    ];

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'order_worker',
            'worker_id',
            'order_id',
            'id',
            'id'
        );
    }

    public function exOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            OrderType::class,
            'worker_ex_order_types',
            'worker_id',
            'order_type_id',
            'id',
            'id'
        );
    }
}
