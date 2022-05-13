<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function(){
    Route::get('/', [QuestionController::class, 'home'])->name('home'); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');  
    
    //Page
    Route::get('/profile/user', [PageController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [PageController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [PageController::class, 'updateProfile']);
    Route::get('profile/user/question', [QuestionController::class, 'userQuestion'])->name('question.user');
    Route::get('profile/save/question', [QuestionController::class, 'userSaveQuestion'])->name('question.save.question');


    // Question 
    Route::get('/question/detail/{slug}', [QuestionController::class, 'detail'])->name('question.detail');
    Route::get('/question/like/{id}', [QuestionController::class, 'like']);    

    // Create Question 
    Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/question/create', [QuestionController::class, 'store'])->name('question.store');   

    // Question Delete 
    Route::get('/question/delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');

    // Question Fixed 
    Route::post('/question/fix/{id}', [QuestionController::class, 'setFix'])->name('question.fix');

    // Question Save 
    Route::post('/question/save/{id}', [QuestionController::class, 'saveQuestion'])->name('question.save');

    // comment 
    Route::post('/question/comment/create', [QuestionController::class, 'createComment']);
});

Route::middleware('AuthUser')->group(function(){
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('post.register');
    
});
