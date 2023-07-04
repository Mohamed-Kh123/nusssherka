@extends('layouts.admin')

@section('content')
<table class="table">
    <thead>
        <th>{{ __('Order Number') }}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Currancy')}}</th>
        <th>{{__('Payment Method')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Transaction Id')}}</th>
        <th>{{__('Status Code')}}</th>
    </thead>

    <tbody>
        <td>{{ $payment->order->number ?? null}}</td>
        <td>{{ $payment->amount }}</td>
        <td>{{ $payment->currancy }}</td>
        <td>{{ $payment->payment_method }}</td>
        <td>{{ $payment->status }}</td>
        <td>{{ $payment->transaction_id }}</td>
        <td>{{ $payment->transaction_data['statusCode'] }}</td>
    </tbody>
</table>
@endsection