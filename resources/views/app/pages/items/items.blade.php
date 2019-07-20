
<?php $bannerheader = "zen sushi items inventory"; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
    <vc-items baseurl ="{{ Url('/') }}"></vc-items>
@endsection
