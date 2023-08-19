@extends('layouts.admin')


@section('title', 'Edit Product')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Bundles</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')

<form action="{{ route('bundles.update', $bundle->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('admin.bundles._form', [
        'button' => 'Update'
    ])
</form>

@endsection
