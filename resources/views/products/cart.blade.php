@extends('layouts.layout')

@section('css')
<link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection



@section('body')
<div class="container-fluid d-flex justify-content-center">
  <div class="card mt-3">
    <div class="row">
      <div class="col-md-8">
        <div class="title">
          <div class="row">
            <div class="col">
              <h4><b>Shopping Cart</b></h4>
              <div class="mx-3 mb-1" id="flash-message"></div>
            </div>
            <div class="col align-self-center text-right text-muted"><span class="total-count">{{count($keys)}}</span> items</div>
          </div>
        </div>
        @php $total = 0; @endphp
        @if (!empty($keys))
        <div class="row border-bottom">
          <div class="row main align-items-center">
            <div class="col-2"></div>
            <div class="col">
              <div class="row text-muted"><small>SKU</small></div>
              <h6 class="row">Name</h6>
            </div>
            <div class="col">
              Quantity
            </div>
            <div class="col">Unit Price</div>
            <div class="col">Total</div>
          </div>
        </div>
        <div id="product-cart">
        @foreach ($products as $key => $product)
        <div class="row border-bottom" id="product-{{$product->id}}">
          <div class="row main align-items-center">
            <div class="col-2"><img class="img-fluid" src="{{$product->image}}"></div>
            <div class="col">
              <div class="row text-muted"><small>{{$product->SKU}}</small></div>
              <h6 class="row">{{$product->name}}</h6>
            </div>
            <div class="col">
              <a class="quantity" data-type="minus" data-product_id="{{$product->id}}">-</a>
              <a href="#" class="border product-count-{{$product->id}}">{{$cart[$product->id]}}</a>
              <a class="quantity" data-type="plus" data-product_id="{{$product->id}}">+</a>
            </div>
            <div class="col">₹ {{$product->our_price;}}</div>
            @php $total += $subTotal = $quantity[$key] * $product->our_price; @endphp
            <div class="col">₹ <span class="product-price-{{$product->id}}">{{ $subTotal }}</span>
              <span class="close" data-product_id="{{$product->id}}">&#10005;</span>
            </div>
          </div>
        </div>
        @endforeach
        </div>
        @else
        <p>Your cart is empty.</p>
        @endif
        <div class="back-to-shop">
          <a href="{{route('products.index')}}">&leftarrow;</a>
          <span class="text-muted">Back to shop</span>
        </div>
      </div>
      <div class="col-md-4 summary">
        <div>
          <h5><b>Summary</b></h5>
        </div>
        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 2vh;">
          <div class="col">Sub Total (<span class="total-count">{{count($keys)}}</span>)</div>
          <div class="col text-right total-price">₹ {{$total}}</div>
        </div>       
        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 2vh;">
          <div class="col">Order Total</div>
          <div class="col text-right total-price">₹ {{$total}}</div>
        </div>
        
        <button class="btn">CHECKOUT</button>
      </div>
    </div>

  </div>
</div>
@endsection