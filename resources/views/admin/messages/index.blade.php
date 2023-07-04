@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Messages</h2>
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Messages</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->subject }}</td>
                <td>{{ $message->message }}</td>
                @can('message.view')
                <td>
                <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
                @can('message.delete')
                <td>
                    <form action="{{route('messages.destroy', $message->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $messages->links() }}
@endsection

