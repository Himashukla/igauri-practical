@extends('layouts.layout')

@section('css')
<link href="{{asset('css/product.css')}}" rel="stylesheet">
@endsection

@section('body')
<div class="container-fluid d-flex justify-content-center mt-3">
  <div class="row">
    Sort By: 
    <select id="sort-select">
      <option value="az">A-Z</option>
      <option value="za">Z-A</option>
      <option value="low-high">Low to High Price</option>
      <option value="high-low">High to Low Price</option>
    </select>
  </div>
</div>

<div class="product-list">
  <div id="loader" class="loader"></div>
  @include('products.product-list')
</div>
@endsection