@extends('layouts.store')

@section('title', 'Orders')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('Orders')}}</li>
</ol>
@endsection



@section('content')
    
    <x-alert />
<div class="table">
    <table class="custom-table">
        <thead>
            <tr>
                <th>{{__('Status')}}</th>
                <th>{{__('Payment Status')}}</th>
                <th>{{__('Total')}}</th>
                <th>{{__('Shipping Name')}}</th>
                <th>{{__('Shipping Address')}}</th>
                <th>{{__('Shipping Phone Number')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ __("$order->status") }}</td>
                <td>{{ __("$order->payment_status") }}</td>
                <td>{{ '$'.$order->total }}</td>
                <td>{{ $order->shipping_name }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->shipping_phone_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    {{ $orders->links() }}
@endsection

