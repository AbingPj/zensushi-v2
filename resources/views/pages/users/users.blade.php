@extends('layout.master')

@section('title', 'Users' )

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-users-cog"></i> {{$page_title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('zen.home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">{{$page_title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <users-page></users-page>
@endsection
