<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;
class Post extends Model
{
    protected $guarded = [];

    public static function generateSlug($title){
        $slug = Str::of($title)->slug('-');
        $count = 1;
        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($title)->slug('-')."-{$count}";
            $count++;
        }
        return $slug;
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
