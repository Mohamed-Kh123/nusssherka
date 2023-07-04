@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Users</h2>
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('statistic.index')}}">Home</a></li>
    <li class="breadcrumb-item active">Users</li>
</ol>
@endsection



@section('content')
    
    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Email Verified At</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{ $user->type }}</td>
                @can('user.update')
                <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $users->links() }}
@endsection

