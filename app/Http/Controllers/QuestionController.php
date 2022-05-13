<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionTag;
use Illuminate\Support\Str;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use App\Models\QuestionComment;
use App\Models\SaveQuestion;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;

class QuestionController extends Controller
{
    use QuestionTrait;

    public function home(Request $request)
    {
        if($slug = $request->tag){
            // check tag 
            $tag = Tag::where('slug', $slug)->first();
            $questions = $tag->question()->with( 'comment', 'savequestion', 'tag')->orderBy('created_at', 'desc')->paginate(3) ;
        }elseif($type = $request->type){
            // answer check
            if($type == 'answer'){
                $questions = Question::whereHas('comment', function($q){
                    $q->where('user_id', Auth::user()->id);
                })->with( 'comment', 'savequestion', 'tag')->orderBy('created_at', 'desc')->paginate(3);
            }
            if($type == 'unanswer'){
                $questions = Question::has('comment', '<', 1)->with( 'comment', 'savequestion', 'tag')->orderBy('created_at', 'desc')->paginate(3);
            }
        }else{
            $questions = Question::with( 'comment', 'savequestion', 'tag')->orderBy('created_at', 'desc')->paginate(3);
        }

        foreach($questions as $k=>$v){
            $questions[$k]->is_like = $this->getLikeDetail($v->id)['is_like'];
            $questions[$k]->like_count = $this->getLikeDetail($v->id)['like_count'];
            $questions[$k]->is_save = $this->getSave($v->id)['is_save'];
        }

        $tag = $request->all() ;
        return Inertia::render('Home', compact('questions', 'tag')) ;
    }

    public function create()
    {
        return Inertia::render('CreateQuestion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required'
        ]);

        $question = Question::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        if($request->filled('tag')){
           foreach($request->tag as $tag){
                QuestionTag::create([
                    'question_id' => $question->id,
                    'tag_id' => $tag
                ]);
           }
        }

        return redirect()->route('home')->with('success', "Asking Question Successful");
    }

    public function detail($slug)
    {
        $question = Question::where('slug', $slug)->with('comment.user','like' ,'tag')->first();
        $question->is_like = $this->getLikeDetail($question->id)['is_like'];
        $question->like_count = $this->getLikeDetail($question->id)['like_count'];
        $question->is_save = $this->getSave($question->id)['is_save'];

        return Inertia::render('QuestionDetail', compact('question'));
    }

    public function like($id)
    {
        QuestionLike::create([
            'question_id' => $id,
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'question_id' => 'required'
        ]);

        $cmt = QuestionComment::create([
            'question_id' => $request->question_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        $comment = QuestionComment::where('id', $cmt->id)->with('user')->first();

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function userQuestion()
    {
        $user = Auth::user()->id;
        $questions = Question::where('user_id', $user)->with('like','comment','savequestion','tag')->orderBy('created_at', 'desc')->paginate(3);        
        foreach($questions as $k=>$v){
            $questions[$k]->is_like = $this->getLikeDetail($v->id)['is_like'];
            $questions[$k]->like_count = $this->getLikeDetail($v->id)['like_count'];
            $questions[$k]->is_save = $this->getSave($v->id)['is_save'];
        }

        return Inertia::render('UserQuestion', compact('questions'));
    }

    public function delete($id)
    {
        $question = Question::where('id', $id)->first();
        $question_tag = QuestionTag::where('question_id', $question->id)->get();

        foreach($question_tag as $qt){
            $qt->delete();
        }
        $question->delete();
        return response()->json(['success'=>true]);


    }

    public function setFix($id)
    {
        $question = Question::where('id', $id)->first();
        $question->update([
            'is_fixed' => 'true'
        ]);

        return response()->json(['success' => true]);
    }

    public function saveQuestion($id)
    {   
        SaveQuestion::create([
            'user_id' => Auth::user()->id,
            'question_id' => $id
        ]);

        return response()->json(['success' => true]);
    }

    public function userSaveQuestion()
    {
        $questions = SaveQuestion::where('user_id', Auth::user()->id)->with('question.like', 'question.comment', 'question.tag', 'question.savequestion')->orderBy('created_at', 'desc')->paginate(3);
        
        return Inertia::render('SaveQuestion', compact('questions'));
    }
}
