<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class RelationController extends Controller
{
    public function one_to_one()
    {
        // $user = User::find(2);
        // dd($user->profile);

        // $profile = Profile::find(1);

        // dd($profile->user);

        // $users = User::with('profile')->get();



        // $user = User::find(3);

        // $user->profile()->create([
        //     'image' => 'ddddd',
        //     'dob' => '10-10-10',
        //     'fb' => 'wwww'
        // ]);

        // Profile::create([
        //     'user_id' => $user->id,
        //     'image' => 'ddddd',
        //     'dob' => '10-10-10',
        //     'fb' => 'wwww'
        // ]);

        // return $users;

        // return view('one_to_one', compact('users'));
    }


    public function one_to_many()
    {
        $post = Post::with('comments.user')->withCount('comments')->find(1);

        // return $post;

        // dd($post->comments);

        // $comment = Comment::find(1);

        // dd($comment->user);

        return view('one_to_many', compact('post'));
    }

    public function add_comment(Request $request)
    {
        // $post = Post::find($request->post_id);

        // $post->comments()->create([

        // ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        $comment->load('user');

        return $comment;
    }

}



// Class A {
//     public function show()
//     {

//     }
// }

// $a = new A();

// $a->show();
