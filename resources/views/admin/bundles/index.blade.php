@extends('layouts.admin')

@section('title')
<div class="d-flex justify-content-between">
    <h2>Bundles</h2>
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('bundles.create') }}">Create</a>
    </div>
</div>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Bundle</li>
</ol>
@endsection

@section('content')

    <x-alert />

    <table class="table">
        <thead>
            <tr>
                <th>Bundles Name</th>
                <th>Price</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($bundles as $bundle)
            <tr>
                <td>{{ $bundle->name }}</td>
                <td>{{ $bundle->price }}</td>
                <td>{{ $bundle->description }}</td>
                <td>
                <a href="{{ route('bundles.edit', $bundle->id) }}" class="btn btn-sm btn-dark">Edit</a>
                </td>
                <td>
                    <form action="{{ route('bundles.destroy', $bundle->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{ $bundles->links() }}


@endsection

