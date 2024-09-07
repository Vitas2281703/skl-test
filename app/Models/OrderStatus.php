<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOrderStatus
 */
class OrderStatus extends Model
{
    protected $fillable = [
        'name',
    ];
}
