<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd($request->all());

        $count = 10;

        if($request->has('count')) {
            $count = $request->count;
            // if($request->count == 'all') {
            //     $count = Post::count();

            // }
        }


        $posts = Post::orderByDesc('id')->paginate($count);

        if($request->has('search')) {
            $posts = Post::where('title', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate($count);
        }

        // $posts = Post::latest('id')->paginate(10);
        // $posts = Post::orderByDesc('id')->simplepaginate(10);
        // $posts = Post::orderByDesc('id')->get();




        // dd($posts);

        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request->all());
        // validation
        // $request->validate([
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:png,jpg,jpeg',
        //     'content' => ['required'],
        // ], [
        //     'title.required' => 'العنوان مطلوب',
        //     'content.required' => 'الوصف مطلوب'
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:png,jpg,jpeg',
        //     'content' => ['required'],
        // ], [
        //     'title.required' => 'العنوان مطلوب',
        //     'content.required' => 'الوصف مطلوب'
        // ])->validate();

        // if($validator->fails()) {
        //     // return [
        //     //     'status' => 0,
        //     //     'message' => 'There is an error',
        //     //     'data' => []
        //     // ];
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        // return  $this->removescript( $request->title );

        // Upload File
        // $imgname = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('/', 'custom');
        // $path = $request->file('image')->move(public_path('images'), $imgname);

        // Save in Database
        // $post = new Post();
        // $post->title = $request->title;
        // $post->slug = Str::slug($request->title);
        // $post->image = $path;
        // $post->content = $request->content;
        // $post->user_id = 1;
        // $post->save();
        $title = $this->removescript($request->title);
        Post::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $path,
            'content' => $this->removescript($request->content),
            'user_id' => 1
        ]);

        // Redirect
        return redirect()->route('admin.posts.index');
        // dd($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Show';
        // $post = Post::find($id);
        // dd($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $path = $post->image;
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('/', 'custom');
        }
        // $path = $request->file('image')->move(public_path('images'), $imgname);

        $title = $this->removescript($request->title);
        $post->update([
            'title' => $title,
            'image' => $path,
            'content' => $this->removescript($request->content),
            'updated_by' => 1
        ]);

        // Redirect
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('admin.posts.index');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->orderByDesc('id')->paginate(10);
        return view('admin.posts.trash', compact('posts'));
    }

    public function restore(Post $post)
    {
        $post->restore();
        return redirect()->route('admin.posts.index');
        // $post->update(['deleted_at' => null]);
    }

    public function forcedelete(Post $post)
    {
        File::delete(public_path('uploads/'.$post->image));
        $post->forcedelete();
        return redirect()->route('admin.posts.index');
        // $post->update(['deleted_at' => null]);
    }

    private function removescript($input) {
        $input = str_replace('<script>', '', $input);
        return str_replace('</script>', '', $input);
    }
}
