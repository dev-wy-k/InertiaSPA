<?php
namespace App\Traits;

use App\Models\QuestionLike;
use App\Models\SaveQuestion;
use Illuminate\Support\Facades\Auth;

trait Question
{
    public function getLikeDetail($question_id)
    {
        // check like 
        $like = QuestionLike::where('question_id', $question_id)->where('user_id', Auth::user()->id)->first();

        if($like){
            $is_like = 'true';
        }else{
            $is_like = 'false';
        }

        // like count 
        $like_count = QuestionLike::where('question_id', $question_id)->count();

        $data['is_like'] = $is_like ;
        $data['like_count'] = $like_count ;

        return $data;
    }

    public function getSave($question_id)
    {
        $save = SaveQuestion::where('question_id', $question_id)->where('user_id', Auth::user()->id)->first();

        if($save){
            $is_save = 'true';
        }else{
            $is_save = 'false';
        }

        $data['is_save'] = $is_save ;

        return $data;
    }
}
