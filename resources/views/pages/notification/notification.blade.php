
<?php $bannerheader = "Notifications"; ?>
@extends('layout.app')

@section('title', 'Notifications' )

@section('content')
  @include('layout.partials.banner')
    <notifications-page></notifications-page>
@endsection
