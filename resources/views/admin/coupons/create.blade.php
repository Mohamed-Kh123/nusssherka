@extends('layouts.admin')


@section('title', 'Create New coupon')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">Coupons</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection




@section('content')

<form action="{{ route('coupons.store') }}" method="post">
    @csrf
    @include('admin.coupons._form', [
        'button' => 'Add',
    ])
</form>

@endsection