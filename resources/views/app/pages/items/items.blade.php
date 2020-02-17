
<?php $bannerheader = ""; ?>
@extends('layout.app')

@section('title', 'Items' )

@section('content')
  @include('layout.partials.banner')
    <vc-items baseurl ="{{ Url('/') }}"></vc-items>
@endsection
