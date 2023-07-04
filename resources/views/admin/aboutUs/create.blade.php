@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('aboutUs.update')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title', $aboutUs->title) }}">
            @error('title')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="">About Us</label>
            <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content">{{ old('content', $aboutUs->content) }}</textarea>
            @error('content')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image_path">
            @error('image')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        @can('aboutUs.create')
        <button type="submit" class="btn btn-primary">Save</button>
        @endcan
    </form>
@endsection
