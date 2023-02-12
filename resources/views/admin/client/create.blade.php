@extends('admin.master')
@section('titel','Add Client')
@section('content')
<h1>Add new Client</h1>
    @include('admin.errors')
    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" >
        </div>

        <button class="btn btn-success px-5">Add</button>
    </form>
@stop
