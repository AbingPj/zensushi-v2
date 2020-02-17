<?php $bannerheader =  "Home"; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
  <div class="container">
    <div class="row">
      <button class="btn btn-primary" onclick="return notif()">Notify</button>
        {{-- <tour-sample></tour-sample> --}}
      
    </div>
  </div>
@endsection
