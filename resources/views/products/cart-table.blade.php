@php $total = 0; @endphp
@foreach ($products as $key => $product)
<div class="row border-bottom">
  <div class="row main align-items-center">
    <div class="col-2"><img class="img-fluid" src="{{$product->image}}"></div>
    <div class="col">
      <div class="row text-muted"><small>{{$product->SKU}}</small></div>
      <h6 class="row">{{$product->name}}</h6>
    </div>
    <div class="col">
      <a class="quantity" data-type="minus" data-product_id="{{$product->id}}">-</a>
      <a href="#" class="border">{{$quantity[$key]}}</a>
      <a class="quantity" data-type="plus" data-product_id="{{$product->id}}">+</a>
    </div>
    <div class="col">₹ {{$product->our_price;}}</div>
    @php $total += $subTotal = $quantity[$key] * $product->our_price; @endphp
    <div class="col">₹ {{ $subTotal }}
      <span class="close">&#10005;</span>
    </div>
  </div>
</div>
@endforeach