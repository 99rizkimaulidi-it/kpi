<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'path',
        'original_name',
        'mime_type',
        'size',
        'visibility',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
