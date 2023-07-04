@include('layouts.admin')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active">{{__('Order Details')}}</li>
</ol>
@endsection

@section('content')
<x-alert />

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
        <tr>
            <td>{{ $order->number }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>
        </tr>
    </tbody>
</table>

@endsection