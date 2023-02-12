@extends('site.master')
@section('titel','Cart |'.env('APP_NAME'))
@section('nav')
<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
@endsection
@section('content')

   @include('site.part.header',['titel'=>'Our Cart','name'=>'Cart taif'])


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                           $app_total=0;
                        @endphp

                        @foreach ($carts as $cart)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('image/product/'.$cart->Product->image) }}" alt="" style="width: 50px;">{{ $cart->Product->name }}</td>
                            <td class="align-middle">${{ $cart->price }}</td>
                            <td class="align-middle">{{ $cart->quantity }}</td>
                            <td class="align-middle">${{ $cart->price*$cart->quantity }}</td>
                            {{-- <td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td> --}}
                            <td class="align-middle">

                                <form class="d-inline" action="{{ route('site.remove_from_cart', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-primary" onclick="return confirm('Are you sure')"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                        @php
                          $app_total+=$cart->price*$cart->quantity
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">${{  $app_total }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{  $app_total+10 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@stop
