
<?php $bannerheader = ""; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
    <vc-items baseurl ="{{ Url('/') }}"></vc-items>
@endsection
