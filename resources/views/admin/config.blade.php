@extends('layouts.admin')


@section('title', 'Settings')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
</ol>
@endsection

@section('content')

    <form action="{{route('settings')}}" method="post">
        @csrf

        <div class="form-group">
            <x-form-input label="App name" name="config[app.name]" :value=" config('app.name')" />
        </div>
        <div class="form-group">
            <x-form-select label="Currency" name="config[app.currency]"  :options="$currencies" :selected="config('app.currency')"/>
        </div>
        <div class="form-group">
            <x-form-select label="Local" name="config[app.local]" :options="$locales" :selected="config('app.local')"/>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
    
@endsection