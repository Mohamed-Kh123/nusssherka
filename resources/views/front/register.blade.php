@extends('layouts.auth')
@section('content')

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="d-flex justify-content-center">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white rounded-3 p-3 d-flex flex-column w-50">
        <img src="{{asset('assets/logo.png')}}" class="logo my-3 align-self-center" style="width: 100px;"/>
        <div class="mt-4 input-container">
            <label>{{trans('lang.name')}}</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" value="{{old('name', request()->get('name'))}}"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4 input-container">
            <label>{{trans('lang.email')}}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" autocomplete="username" required value="{{old('email', request()->get('email'))}}" />
        </div>

        <!-- Password -->
        <div class="mt-4 input-container">
            <label for="password">{{trans('lang.password')}}</label>
            <input id="password" class="block mt-1 w-full"
                   type="password"
                   name="password"
                   required autocomplete="new-password" />

        </div>

        <!-- Confirm Password -->
        <div class="mt-4 input-container">
            <label for="password_confirmation">{{trans('lang.password_confirmation')}}</label>

            <input id="password_confirmation" class="block mt-1 w-full"
                   type="password"
                   name="password_confirmation" required autocomplete="new-password" />

        </div>

        <!-- Phone Number -->
        <div class="mt-4 input-container">
            <label for="phone_number">{{trans('lang.phone_number')}}</label>
            <input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{old('phone_number', request()->get('phone_number'))}}" required autocomplete="username" />
        </div>

        <div class="mt-4 input-container">
            <button type="submit" class="btn">{{trans('lang.create')}}</button>
        </div>
    </div>
</form>
@endsection
