@extends('layouts.admin', ['title'=>'Categories'])

@section('content')
<div class="container">
    {{-- Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="deleteModalLabel">Confirm Category Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category with id #@{{itemId}} ?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" @@click="submitForm()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /Modal --}}

    <a href="{{route('admin.categories.create')}}" class="btn btn-outline-primary text-uppercase mb-5">Add New Category</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Detail</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a href="{{route('admin.categories.show', $category->id)}}" class="btn cs_btn">View</a>
                </td>
                <td>
                    <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger text-uppercase" @@click="openModal($event, {{$category->id}})">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$categories->links()}}
</div>
@endsection