
<?php $bannerheader = "zen sushi items inventory"; ?>
@extends('layout.app')

@section('content')
  @include('layout.partials.banner')
   <div class="container">
       <div class="row">
           <div class="col">
            <form action="">
                <div class="form-group">
                    <label for="">Item Type</label>
                    <input type="text" name="item_type" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="" id="category"></select>
                </div>
            </form>
           </div>
       </div>
   </div>
@endsection
