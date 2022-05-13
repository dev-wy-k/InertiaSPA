<?php

namespace App\Models;

use App\Models\QuestionLike;
use App\Models\SaveQuestion;
use App\Models\QuestionComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tag;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'user_id',
        'title',
        'description',
        'is_fixed',
    ];

    public function Like()
    {
        return $this->hasMany(QuestionLike::class, 'question_id');
    }

    public function Comment()
    {
        return $this->hasMany(QuestionComment::class, 'question_id');
    }

    public function SaveQuestion()
    {
        return $this->hasMany(SaveQuestion::class, 'question_id');
    }

    public function Tag()
    {
        return $this->belongsToMany(Tag::class, 'question_tags');
    }

}
