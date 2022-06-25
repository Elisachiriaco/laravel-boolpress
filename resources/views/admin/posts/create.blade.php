@extends('layouts.admin', ['title'=>'Create Post'])

@section('content')
    <div class="container">
        <h1>Create new Post</h1>
        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                @error('title')
                    <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                @error('content')
                    <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image Url</label>
                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
                @error('image')
                    <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <h6>Tags</h6>
                @foreach($tags as $tag)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input @error('category_id') is-invalid @enderror" name="tags[]" id="{{$tag->name}}" {{in_array($tag->id,old('tags',[])) ? 'checked' : ''}} value="{{$tag->id}}">
                    <label class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>
                </div>
                @endforeach
                @error('category_id')
                    <div class="alert alert-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="publish" id="publish" {{old('publish') ? 'checked' : ''}}>
                <label class="form-check-label" for="publish">Published</label>
            </div>
            <button type="submit" class="btn cs_btn">Add</button>
        </form>
    </div>
@endsection