<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    protected $validationRule = [
        'title'=> 'required|max:100',
        'content'=> 'required',
        'category_id'=> 'required|exists:categories,id',
        'image'=> 'nullable|mimes:jpeg,bmp,png,svg,jpg',
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
        // image
        if(isset($data['image'])) {
            $path_image = Storage::put('uploads', $data['image']);
            $newPost->image = $path_image;
        }
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
        if($post->title != $data['title']){
            $post->title = $data['title'];
            $slug = Str::of($post->title)->slug("-");
            if($slug != $post->slug) {
                $post->slug = $this->getSlug($post->title);
            }
        }
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->published = isset($data["published"]);
        if( isset($data['image']) ) {
            // cancello l'immagine
            Storage::delete($post->image);
            // salvo la nuova immagine
            $path_image = Storage::put("uploads", $data['image']);
            $post->image = $path_image;
        }
        $post->update();

        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }
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
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with("message","Post with id: {$post->id} successfully deleted !");
    }
        /**
     * Generate an unique slug
     *
     * @param  string $title
     * @return string
     */
    private function getSlug($title)
    {
        $slug = Str::of($title)->slug("-");
        $count = 1;

        // Prendi il primo post il cui slug ?? uguale a $slug
        // se ?? presente allora genero un nuovo slug aggiungendo -$count
        while( Post::where("slug", $slug)->first() ) {
            $slug = Str::of($title)->slug("-") . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
