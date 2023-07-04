@extends('layouts.admin')


@section('title', 'Edit role')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">roles</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')

<form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('admin.roles._form', [
        'button' => 'Update'
    ])
</form>

@endsection