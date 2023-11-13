<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Token extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'is_used',
        'tokenable_type',
        'tokenable_id',
        'expired_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }
}
