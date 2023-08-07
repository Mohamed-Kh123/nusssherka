@extends('layouts.store')

@section('content')

    <div class="table">
        <table class="custom-table">
            <caption>{{__('Orders')}}</caption>
            <thead>
            <tr>
                <th scope="col"> {{__("id")}}</th>
                <th scope="col">{{__('status')}}</th>
                <th scope="col">{{__('payment_status')}}</th>
                <th scope="col">{{__('total')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr id="{{$order->id}}">
                    <td data-label="id">{{$order->id}}</td>
                    <td data-label="Account">{{__("$order->status")}}</td>
                    <td data-label="Due Date">{{__("$order->payment_status")}}</td>
                    <td data-label="Amount">${{$order->total}}</td>
                    @if($order->status == "pending" && $order->payment_status == "unpaid")
                        <td>
                            <form action="{{route('orders.paymentIntent.create', $order->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="paypal">
                                <button class="dropdown-item" class="btn btn-primary"  @if($order->total == 0) disabled @endif>{{__('Pay with paypal')}}</button>
                            </form>
                        </td>
                    @elseif($order->payment_status == "paid")
                        <td><a href="" class="btn btn-success disabled">{{__('Paid')}}</a></td>
                    @else
                        <td><a href="" class="opacity-25 btn btn-dark disabled">{{__('Cancelled')}}</a></td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
