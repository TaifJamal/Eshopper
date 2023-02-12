<div class="card product-item border-0 mb-4">
    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
        <img class="img-fluid w-100" src="{{ asset('image/product/'.$product->image) }}" alt="">
    </div>
    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
        <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
        <div class="d-flex justify-content-center">
            <h6>${{ $product->price }}</h6><h6 class="text-muted ml-2"><del>{{ $product->oldBrice ? '$'.$product->oldBrice:'' }}</del></h6>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between bg-light border">
        <a href="{{ route('site.detail',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
        <form action="{{ route('site.add_to_cart') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
        </form>
    </div>
</div>
