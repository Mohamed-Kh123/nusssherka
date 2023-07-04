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
    <form action="{{route('contact.update')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Contact Us</label>
            <textarea type="text" class="form-control @error('contact_us') is-invalid @enderror" name="contact_us">{{ old('contact_us', $contact->contact_us) }}</textarea>
            @error('contact_us')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                value="{{ old('address', $contact->address) }}">
            @error('address')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Mobile</label>
            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                value="{{ old('mobile', $contact->mobile) }}">
            @error('mobile')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control @error('Email') is-invalid @enderror" name="email"
                value="{{ old('email', $contact->email) }}">
            @error('Email')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        @can('contact.create')
        <button type="submit" class="btn btn-primary">Save</button>
        @endcan
    </form>
@endsection
