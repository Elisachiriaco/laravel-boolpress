@extends('layouts.admin', ['title'=>'Edit #'.$category->id])

@section('content')
<div class="container">
    <h1>Edit Category #{{$category->id}}</h1>
    <form action="{{route('admin.categories.update', $category->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$category->name}}">
            @error('name')
                <div class="alert alert-danger"> {{$message}} </div>
            @enderror
        </div>
        <button type="submit" class="btn cs_btn">Edit</button>
    </form>
</div>
@endsection