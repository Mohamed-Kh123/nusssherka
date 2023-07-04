@extends('layouts.store')
@section('content')
    {{-- <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Address') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{ asset('storage/' . $image->image_path) }}" width="60" height="60"></td>
                <td>{{$profile->user->name}}</td>
                <td>{{$profile->user->email}}</td>
                <td>{{$profile->address}}</td>
            </tr>
        </tbody>
    </table> --}}
    <div class="form-floating">
        <input type="text" class="form-control" value="{{ $profile->user->name }}" disabled>
        <label for="floatingPassword">Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" value="{{ $profile->user->email }}" disabled>
        <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="{{ $profile->address }}" disabled>
        <label for="floatingInput"></label>
    </div>
    <div class="form-floating">
        <img src="{{ asset('storage/' . $image->image_path) }}" width="60" height="60">
        <label for="floatingPassword">Image</label>
    </div>
@endsection
