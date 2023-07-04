@extends('layouts.admin')


@section('title', 'Create New Notification')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">Notifications</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')

<div class="form-check">
    <input class="form-check-input" type="radio" name="user" id="flexRadioDefault1">
    <label class="form-check-label" for="flexRadioDefault1">
      User
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="user" id="flexRadioDefault2" checked>
    <label class="form-check-label" for="flexRadioDefault2">
      All Users
    </label>
</div>

<form action="{{ route('notifications.store') }}" method="post" enctype="multipart/form-data" id="form1" style="display: none">
    @csrf
    <input type="hidden" name="type" value="user">
    @include('admin.notifications._form', [
        'button' => 'Add',
    ])
</form>

<form action="{{ route('notifications.store') }}" method="post" enctype="multipart/form-data" id="form2">
    @csrf
    <input type="hidden" name="type" value="all_user">

    @include('admin.notifications._form2', [
        'button' => 'Add',
    ])
</form>

@endsection