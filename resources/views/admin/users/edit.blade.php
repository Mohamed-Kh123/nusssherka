@extends('layouts.admin')


@section('title', 'Edit User')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('users.update', $user->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.users._form', [
        'button' => 'Update'
    ])
</form>

@endsection