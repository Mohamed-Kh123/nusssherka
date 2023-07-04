@extends('layouts.admin')

@section('title')
@can('category.create')
<a href="{{ route('categories.create') }}">Create</a>
@endcan
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Categories</li>
</ol>
@endsection

@section('content')

<x-alert />


<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Slug') }}</th>
            <th>{{__('Parent Name')}}</th>
            <th>{{ __('Status') }}</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td><img src="{{asset('storage/'.$category->image_path)}}" alt="" width="60" height="60"></td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->parent->name ?? 'No Parent'}}</td>
            <td>{{ $category->status }}</td>
            @can('category.update')
            <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-dark">{{ __('Edit') }}</a></td>
            @endcan
            @can('category.delete')
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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

{{ $categories->links() }}

@endsection