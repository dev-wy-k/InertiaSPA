<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Wai Yan Kyaw',
            'email'=> 'wyk@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'default.png'
        ]);

        Question::create([
            'title' => "What's new in Laravel 9 ?",
            'slug' => Str::slug("What's new in Laravel 9 ?"),
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia exercitationem illum a molestiae praesentium quae, laudantium nulla et incidunt. Beatae eaque minima quam? Consectetur labore velit consequatur alias beatae illum?',
            'user_id' => 1
        ]);

        Tag::create([
            'name' => 'Web Development',  
            'slug' => Str::slug('Web Development'),
        ]);

        Tag::create([
            'name' => 'Mobile Development',  
            'slug' => Str::slug('Mobile Development'),
        ]);

        Tag::create([
            'name' => 'Web Design',  
            'slug' => Str::slug('Web Design'),
        ]);

        QuestionTag::create([
            'question_id' => 1,
            'tag_id' => 2
        ]);

        QuestionTag::create([
            'question_id' => 1,
            'tag_id' => 1
        ]);
    }
}


