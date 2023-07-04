@extends('layouts.admin')

@section('title')
@can('role.create')
<a href="{{ route('roles.create') }}">Create</a>
@endcan
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">roles</li>
</ol>
@endsection

@section('content')

<x-alert />


<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{__('Created_At')}}</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->created_at }}</td>
            @can('role.update')
            <td><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-dark">{{ __('Edit') }}</a></td>
            @endcan
            @can('role.delete')
            <td>
                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                </form>
            </td>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>

{{ $roles->links() }}

@endsection