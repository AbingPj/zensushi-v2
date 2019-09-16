
<?php $bannerheader = "records"; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
  <vc-records baseurl ="{{ Url('/') }}"></vc-records>
@endsection
