<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));

    }

    public function store(){
    $data = request()->validate([
        'title' => 'required|string',
        'content' => 'string',
        'image' => 'string',
        'category_id' => '',
        'tags' => ''
    ]);
    $tags = $data['tags'];
    unset($data['tags']);

    $post = Post::create($data);
    $post->tags()->attach($tags);

    return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
      return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    public function update(Post $post){
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }
    public function delete(){
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index');
    }


    public function firstOrCreate(){

        $anotherPost =
            [
                'title' => 'some post from shtorm',
                'content' => ' some content from shtorm',
                'image' => 'some.jpg',
                'likes' => 50,
                'is_published' => 1,
            ];
        $post = Post::firstOrCreate([
            'title' => 'ome titile from shtorm',
        ],[
            'title' => 'ome titile from shtorm',
            'content' => ' some content from shtorm',
            'image' => 'some.jpg',
            'likes' => 50,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('finished');
    }
    public function updateOrCreate(){
        $anotherPost =
            [
                'title' => 'updateorcreate some post from shtorm',
                'content' => 'updateorcreate some content from shtorm',
                'image' => 'updateorcreatesome.jpg',
                'likes' => 20,
                'is_published' => 1,
            ];

        $post = Post::updateOrCreate(
            ['title' => 'ome titile from not shtorm',
                ], [
            'title' => 'ome titile from not shtorm',
            'content' => 'its not updateorcreate some content from shtorm',
            'image' => 'updateorcreatesome.jpg',
            'likes' => 20,
            'is_published' => 1,

        ]);dump($post->content);
    }

}
