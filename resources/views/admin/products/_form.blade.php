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
        <label for="">Product Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $product->name) }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Category Name</label>
        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('categoty_id', $product->category_id)) selected @endif>
                    {{ $category->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Price</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
            value="{{ old('price', $product->price) }}">
        @error('price')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Discount</label>
        <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount"
            value="{{ old('discount', $product->discount) }}">
        @error('discount')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $product->description) }}</textarea>
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
        <label for="status">Status</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-active" value="1"
                    @if (old('status', $product->status) == '1') checked @endif>
                <label class="form-check-label" for="status-active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-draft" value="0"
                    @if (old('status', $product->status) == '0') checked @endif>
                <label class="form-check-label" for="status-draft">
                    Draft
                </label>
            </div>
        </div>
        @error('status')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button }}</button>
    </div>
