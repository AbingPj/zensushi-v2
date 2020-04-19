@extends('layout2.master')

@section('title', 'Production' )

@section('content')
<div class="container">
    <vc-items-raw-product-in
        item_id="{{$item_id}}"
        item_raw_stock_out="{{$item_raw_stock_out}}"
        product_item_id="{{$product_item_id}}"
    ></vc-items-raw-product-in>
</div>
@endsection
