@extends('layouts.admin')


@section('title', 'Edit Order')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Orders</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection



@section('content')

<form action="{{ route('orders.update', $order->id) }}" method="post" >
    @csrf
    @method('put')
    
    @include('admin.orders._form', [
        'button' => 'Update'
    ])
</form>

@endsection