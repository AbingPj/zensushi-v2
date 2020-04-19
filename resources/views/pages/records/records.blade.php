@extends('layout2.master')

@section('title', 'Records' )

@section('content')
   <vc-records baseurl ="{{ Url('/') }}"></vc-records>
@endsection
