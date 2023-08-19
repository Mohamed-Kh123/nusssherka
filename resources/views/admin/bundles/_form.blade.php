    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="">Bundle Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $bundle->name) }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Price</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
            value="{{ old('price', $bundle->price) }}">
        @error('price')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $bundle->description) }}</textarea>
        @error('description')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
        @error('image')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button }}</button>
    </div>
