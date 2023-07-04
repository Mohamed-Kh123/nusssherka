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
        <label for="">Coupon Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
               value="{{ old('name', $coupon->code) }}">
        @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Coupon Code</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
            value="{{ old('code', $coupon->code) }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Coupon Discount</label>
        <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount"
            value="{{ old('discount', $coupon->discount) }}">
        @error('discount')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Coupon Limit</label>
        <input type="text" class="form-control @error('limit') is-invalid @enderror" name="limit"
               value="{{ old('limit', $coupon->limit) }}">
        @error('limit')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Expire Date</label>
        <input type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date"
            value="{{ old('expire_date', $coupon->expire_date) }}">
        @error('expire_date')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>


    <div class="form-group">
        <label for="">Coupon Description</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description">
            {{ old('description', $coupon->description) }}
        </textarea>
        @error('description')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <select class="form-select" aria-label="Default select example" name="status">
            <option value="1" @if('1' == old('1', $coupon->status)) selected @endif>Active</option>
            <option value="0" @if('0' == old('0', $coupon->status)) selected @endif>In Active</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$button}}</button>
