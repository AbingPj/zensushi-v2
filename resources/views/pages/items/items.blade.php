@extends('layout2.master')

@section('title', 'Inventory' )

@section('content')
     {{-- <vc-items baseurl ="{{ Url('/') }}"></vc-items> --}}
     <inventory-page></inventory-page>
@endsection
