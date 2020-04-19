
@extends('layout2.master')

@section('title', 'Create Item' )

@section('content')
    <div class="container">
        <vc-items-create itemtype="{{ $itemType }}" categories="{{ $categories }}" units="{{ $units }}" rawitems="{{ $rawItems }}">
        </vc-items-create>
    </div>
@endsection
