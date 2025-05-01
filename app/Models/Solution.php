<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'points',
        'evaluated_at',
        'task_id',
        'user_id',
    ];

    protected $casts = [
        'evaluated_at' => 'datetime',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function student()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function isEvaluated()
    {
        return $this->evaluated_at !== null;
    }

}
