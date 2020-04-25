
@extends('layout2.master')

@section('title', 'Create Item' )

@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$page_title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('zen.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('zen.inventory')}}">{{$page_title}}</a>
                            </li>
                            <li class="breadcrumb-item active">Create New Item</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <items-create
            itemtype="{{ $itemType }}"
            categories="{{ $categories }}"
            units="{{ $units }}"
            rawitems="{{ $rawItems }}">
        </items-create>

@endsection
