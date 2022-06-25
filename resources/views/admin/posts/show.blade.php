@extends('layouts.admin', ['title' => '#'.$post->id])

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-8">
                <h1 class="text-uppercase mt-3">{{$post->title}}</h1>
                @if($post->image)
                    <img src="{{$post->image}}" alt="{{$post->title}}">
                @endif
            </div>
            <div class="col-4 align-self-center">
                <div class="d-flex flex-column gap-2 mx-auto">
                    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning text-uppercase" type="button">Edit</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3 class="text-uppercase">Content</h3>
                <p>{{$post->content}}</p>
            </div>
            <div class="col-6">
                <h3 class="text-uppercase">Info</h3>
                <p class="border-bottom border-3 py-3 mb-0">Creation Date: {{$post->created_at}}</p>
                <p class="border-bottom border-3 py-3 mb-0">Category: {{$post->category ? $post->category->name : 'Not Defined'}}</p>
                @if($post->publish)
                    <p class="border-bottom border-3 py-3 mb-0 text-uppercase text-success fw-bold">Published</p>
                @else
                    <p class="border-bottom border-3 py-3 mb-0 text-uppercase text-danger fw-bold">To publish</p>
                @endif
                <div class="border-bottom border-3 py-3 ">
                    <p class="mb-0">Tags:</p>
                    <ul>
                        @foreach ($post->tags as $item)
                            <li>{{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection