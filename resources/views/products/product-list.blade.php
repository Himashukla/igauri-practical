<div class="container-fluid d-flex justify-content-center">

  <div class="row mt-5">
    @foreach($products as $product)
    <div class="col-sm-4 mt-3">
      <div class="card">
        <img src="{{asset($product->image)}}" class="card-img-top" width="100%">
        <div class="card-body pt-0 px-0">
          <div class="d-flex flex-row justify-content-between mt-1 px-3">
            <h5>{{$product->name}}</h5>
          </div>
          <div class="d-flex flex-row justify-content-between px-3">
            <p>{{ \Str::limit($product->description, 110) }}</p>
          </div>
          <hr class="mt-2 mx-3">
          <div class="d-flex flex-row justify-content-between mb-0 px-3">
            <small class="text-muted mt-1">SKU</small>
            <h6>{{$product->SKU}}</h6>
          </div>
          <div class="d-flex flex-row justify-content-between p-3 mid">
            <div class="d-flex flex-column">
              <small class="text-muted mb-2">Retail Price</small>
              <div class="d-flex flex-row">
                <h5 class="ml-1"><s>₹ {{$product->retail_price}}</s></h5>
              </div>
            </div>
            <div class="d-flex flex-column">
              <small class="text-muted mb-2">Our Price</small>
              <div class="d-flex flex-row">
                <h5 class="ml-1">₹ {{$product->our_price}}</h5>
              </div>
            </div>
          </div>
          <div class="mx-3 mt-3 mb-1">
            <button type="button" class="btn btn-danger btn-block cart" data-product_id="{{$product->id}}"><small>Add to
                Cart</small></button>
          </div>
        </div>
        <div class="mx-3 mb-1" id="flash-messages-{{$product->id}}"></div>
      </div>
    </div>
    @endforeach

    <div class="d-flex flex-row justify-content-between mt-3 px-3">
      {{ $products->links() }}
    </div>
  </div>
</div>