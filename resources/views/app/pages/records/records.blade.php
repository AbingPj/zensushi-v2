
<?php $bannerheader = "Records"; ?>
@extends('layout.app')

@section('title', 'Records' )

@section('content')
  @include('layout.partials.banner')
  <vc-records baseurl ="{{ Url('/') }}"></vc-records>
@endsection
