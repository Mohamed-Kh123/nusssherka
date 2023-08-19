@extends('layouts.admin')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item active">{{__('Order Details')}}</li>
    </ol>
@endsection

@section('content')
    <x-alert/>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">تفاصيل الطلب</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="direction: rtl">
                    @foreach($order->form_data as $key => $value)
                        <div class="input-container" style="align-items: start">
                            <label>{{ trans('lang.'.$key) }}</label>
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <span>{{ is_string($v) ? htmlspecialchars($v) : '' }}</span>
                                @endforeach
                            @else
                                <span>{{ is_string($value) ? htmlspecialchars($value) : '' }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>{{__('Order Number')}}</th>
            <th>تفاصيل الطلب</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Payment Status')}}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $order->number }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    تفاصيل الطلب
                </button>
            </td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>
        </tr>
        </tbody>
    </table>

@endsection
