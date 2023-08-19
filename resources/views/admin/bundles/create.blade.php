@extends('layouts.admin')


@section('title', 'Create New Bundle')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('bundles.create')}}">Bundles</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')

<form action="{{ route('bundles.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('admin.bundles._form', [
        'button' => 'Add',
    ])
</form>

@endsection
