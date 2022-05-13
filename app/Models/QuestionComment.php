<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'user_id',
        'comment'
    ];
    protected $appends = ['date']; 

    public function user()
    {       
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function getDateAttribute()
    {
        $c = new Carbon($this->created_at);
        return $c->diffForHumans();
    }
}
