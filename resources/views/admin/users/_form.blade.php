    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-groub">
        <select class="form-select" aria-label="Default select example" name="type">
            <option value="user" @if('user' == old('user', $user->type)) selected @endif>User</option>
            <option value="admin" @if('admin' == old('admin', $user->type)) selected @endif>Admin</option>
            <option value="super-admin" @if('super-admin' == old('super-admin', $user->type)) selected @endif>Super-admin</option>
          </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$button}}</button>
    