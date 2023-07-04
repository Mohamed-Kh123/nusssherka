@extends('layouts.admin')


@section('title', 'Edit Notification')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">Notifications</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')

<form action="{{ route('notifications.update', $notification->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @include('admin.notifications._form', [
        'button' => 'Update'
    ])
</form>

@endsection