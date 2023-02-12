@extends('admin.master')
@section('titel','Products')
@section('content')

    <h1>All Products</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>OldBrice</th>
                <th>Price</th>
                <th>Description</th>
                <th>Size</th>
                <th>Color</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($products as $product)
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->oldBrice }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{!! $product->description !!}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->color }}</td>
                    <td>{{ $product->Category->name }}</td>
                    <td><img src="{{ asset('image/product/'.$product->image)}}" width="80"  alt=""></td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@stop
