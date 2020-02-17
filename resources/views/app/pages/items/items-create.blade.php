<?php $bannerheader = ""; ?>
@extends('layout.app')

@section('title', 'Items' )

@section('content')
@include('layout.partials.banner')
<div class="container">

  <vc-items-create itemtype="{{ $itemType }}" categories="{{ $categories }}" units="{{ $units }}" rawitems="{{ $rawItems }}">
  </vc-items-create>

</div>
@endsection