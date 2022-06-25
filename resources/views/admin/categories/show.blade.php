@extends('layouts.admin', ['title'=> '#'.$category->id])

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-8">
            <h1 class="text-uppercase mt-3">#{{$category->id}}</h1>
        </div>
        <div class="col-4 align-self-center">
            <div class="d-flex flex-column gap-2 mx-auto">
                <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-warning text-uppercase" type="button">Edit</a>
            </div>
        </div>
    </div>
    <div>
        <p class="border-bottom border-3 py-3 mb-0">Name: <span class="text-uppercase">{{$category->name}}</span></p>
        <p class="border-bottom border-3 py-3 mb-0">Created at: <span class="text-uppercase">{{$category->created_at}}</span></p>
        <div class="border-bottom border-3 py-3">
            <p class="text-uppercase mb-0">Posts with this category:</p> 
            @if (count($category->posts) > 0)
                @foreach ($category->posts as $post)
                    <p class="mb-0">#{{$post->id}} - {{$post->title}}</p>
                @endforeach
            @else
                <p class="mb-0">There are no posts with this category</p>
            @endif
        </div>
    </div>
</div>
@endsection