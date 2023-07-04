@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>notifications</h2>
    @can('notification.create')
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('notifications.create') }}">Create</a>
    </div>
    @endcan
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">notifications</li>
</ol>
@endsection

@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Notification title</th>
                <th>Body</th>
                <th>Url</th>
                <th>Action</th>
                <th>User Id</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr>
                
                <td>{{ $notification->data['title'] }}</td>
                <td>{{ $notification->data['body'] }}</td>
                <td>{{ $notification->data['url'] }}</td>
                <td>{{ $notification->data['action'] ?? null }}</td>
                <td>{{ $notification->data['user_id'] ?? null}}</td>
                @can('notification.delete')
                <td>
                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>    
    {{$notifications->links()}}
@endsection

