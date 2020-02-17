
<?php $bannerheader = "Delivery Request"; ?>
@extends('layout.app')

@section('title', 'Delivery Request' )

@section('content')
  @include('layout.partials.banner')
  <delivery-request-page></delivery-request-page>
@endsection
