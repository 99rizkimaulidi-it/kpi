<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KpiScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period',
        'average_score',
        'total_tasks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
