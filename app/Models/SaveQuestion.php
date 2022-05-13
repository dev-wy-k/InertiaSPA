<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaveQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'user_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
