@extends('layouts.admin')


@section('title', 'Edit Coupon')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">Coupons</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('coupons.update', $coupon->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.coupons._form', [
        'button' => 'Update'
    ])
</form>

@endsection