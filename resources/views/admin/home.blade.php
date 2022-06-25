@extends('layouts.admin', ['title'=>'Home'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
                        <li><a href="{{route('admin.posts.create')}}">Add Post</a></li>
                        <li><a href="{{route('admin.categories.index')}}">Categories</a></li>
                        <li><a href="{{route('admin.categories.create')}}">Add Category</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
