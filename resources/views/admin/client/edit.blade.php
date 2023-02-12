@extends('admin.master')
@section('titel','Edit Client')
@section('content')
<h1>Edit new Client</h1>

    @include('admin.errors')
    <form action="{{ route('admin.clients.update',$client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" >
            <img src="{{ asset('image/client/'.$client->image)}}" width="80"  alt="">
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
