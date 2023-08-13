@extends('layouts.auth')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->

    <form method="POST" action="{{ route('login') }}" class="d-flex justify-content-center">
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
        <div class="w-75 p-3 bg-white rounded-3 text-center"
             style="position: absolute; top: 50%; left:50%; transform: translate(-50%, -50%)">
            <img src="{{asset('assets/logo.png')}}" class="logo my-3"/>
            <!-- Email Address -->
            <div class="input-container">
                <label>{{trans('lang.email')}}</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email"
                       value="{{old('email', request()->get('email'))}}"/>
            </div>

            <!-- Password -->
            <div class="mt-4 input-container">
                <label>{{trans('lang.password')}}</label>

                <input id="password" class="block mt-1 w-full"
                       type="password"
                       name="password"
                       required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="d-block text-end mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ trans('lang.remember_me') }}</span>
                </label>
            </div>

            <div class="d-flex items-center justify-content-center mt-4">
                <button class="ml-3 btn btn--animated px-5">
                    {{ trans('lang.log_in') }}
                </button>
            </div>
        </div>
    </form>
@endsection
