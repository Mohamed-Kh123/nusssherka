@extends('layouts.admin')

@section('title', 'Payments')


@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Payments</li>
</ol>
@endsection

@section('content')

<x-alert />


<table class="table">
    <thead>
        <tr>
            <th>{{ __('Order Number') }}</th>
            <th>{{__('Amount')}}</th>
            <th>{{__('Currancy')}}</th>
            <th>{{__('Payment Method')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Transaction Id')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->order->number ?? null }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->currancy }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->transaction_id }}</td>
            @can('payment.show')
            <td><a href="{{route('payments.show', $payment->id)}}" class="btn btn-sm btn-dark">Show</a></td>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>

{{ $payments->links() }}

@endsection