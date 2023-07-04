@extends('layouts.store')

@section('content')


<div class="table">
    <table class="custom-table">
      <caption>{{__('Orders')}}</caption>
      <thead>
        <tr>
          <th scope="col">{{__('Status')}}</th>
          <th scope="col">{{__('Payment Status')}}</th>
          <th scope="col">{{__('Total')}}</th>
          <th></th>
        </tr>
      </thead>  
      <tbody>
          @foreach($orders as $order)
              <tr id="{{$order->id}}">
                  <td data-label="Account">{{__("$order->status")}}</td>
                  <td data-label="Due Date">{{__("$order->payment_status")}}</td>
                  <td data-label="Amount">${{$order->total}}</td>
                  @if($order->status == "pending" && $order->payment_status == "unpaid")
                  <td><div class="dropdown">
                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{__('Pay now!')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="{{route('orders.paymentIntent.create', $order->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="paypal">
                                <button class="dropdown-item" class="btn btn-primary">{{__('Pay with paypal')}}</button>
                            </form>
                            <form action="{{route('orders.paymentIntent.create', $order->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="stripe">
                                <button class="dropdown-item" class="btn btn-primary">{{__('Pay with viza')}}</button>
                            </form>
                        </div>
                      </div></td>
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
