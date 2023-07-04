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
        <label for="">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
        @error('title')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Action</label>
        <input type="text" class="form-control @error('action') is-invalid @enderror" name="action">
        @error('action')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">User Name</label>
        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
            <option value=""></option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

        <div class="form-group">
            <label for="">Body</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="body"></textarea>
            @error('body')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">URL</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url">
            @error('url')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>

