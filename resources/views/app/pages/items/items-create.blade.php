
<?php $bannerheader = "zen sushi items inventory"; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
   <div class="container">
        
    
    <vc-items-create itemtype="{{ $itemType }}" categories="{{ $categories }}" units="{{ $units }}">
        </vc-items-create>
    
    
   </div>
@endsection
