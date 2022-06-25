<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;
class Category extends Model
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
    //collegamento per la foreign key, il nome deve essere al plurale
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
