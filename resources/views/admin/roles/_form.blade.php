    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="form-group">
        <label for="">{{ __('Role Name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $role->name) }}">
        @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        @foreach(config('abilities') as $key => $value)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$key}}" name="abilities[]" @if(in_array($key, $role->abilities ?? [])) checked @endif>
                <label class="form-check-label">
                {{$value}}
                </label>
            </div>
        @endforeach
    </div>
   
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button }}</button>
    </div>