<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    protected $validationRule = [
        'title'=> 'required|max:100',
        'content'=> 'required',
        'category_id'=> 'required|exists:categories,id',
        'image'=> 'nullable|max:255',
        'publish'=> 'sometimes|accepted',
        'tags'=> 'nullable|exists:tags,id',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(8);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories'), compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione
        $request->validate($this->validationRule);
        //dati
        $data = $request->all();
        //creazione e salvataggio nuovo post
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->image = $data['image'];
        $newPost->category_id = $data['category_id'];
        $newPost->publish = isset($data['publish']);
        $newPost->slug = Post::generateSlug($data['title']);
        $newPost->save();
        //tags
        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);        
        }
        //reindirizzare alla show del nuovo post
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validazione
        $request->validate($this->validationRule);
        //dati
        $data = $request->all();
        //creazione e salvataggio modifiche post
        if($post->title != $data['title']){
            $post->slug = Post::generateSlug($data['title']);
        }
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->image = $data['image'];
        $post->publish = isset($data['publish']);
        $post->category_id = $data['category_id'];
        $post->save();
        //tags
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);        
        }
        //reindirizzare alla show del nuovo post
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
