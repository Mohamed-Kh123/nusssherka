@extends('layouts.admin')

@section('title', 'Orders')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Orders</li>
</ol>
@endsection



@section('content')
    
    <x-alert />
    <form action="{{route('orders.index')}}" method="get">
        <div class="product-select-box">
            <div class="product-short">
                <p>Sort By:</p>
                <select class="nice-select" name="sortBy" id="category-select">
                    <option value="pending" @if('pending' == request()->sortBy) selected @endif>{{__('Pending')}}</option>
                    <option value="cancelled" @if('cancelled' == request()->sortBy) selected @endif>{{__('Cancelled')}}</option>
                    <option value="processing" @if('processing' == request()->sortBy) selected @endif>{{__('Processing')}}</option>
                    <option value="shipped" @if('shipped' == request()->sortBy) selected @endif>{{__('Shipped')}}</option>
                    <option value="paid" @if('paid' == request()->sortBy) selected @endif>{{__('paid')}}</option>
                    <option value="unpaid" @if('unpaid' == request()->sortBy) selected @endif>{{__('unpaid')}}</option>
                    <option value="completed" @if('completed' == request()->sortBy) selected @endif>{{__('completed')}}</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">{{__('Filter')}}</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>{{__('Order Number')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Payment Status')}}</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->number }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_status }}</td>
                @can('order.update')
                <td>
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                <td>
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-dark">show</a>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $orders->links() }}
@endsection

