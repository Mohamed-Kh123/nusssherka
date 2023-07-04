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
        <select class="form-select" aria-label="Default select example" name="status">
            <option value="pending" @if('pending' == old('pending', $order->status)) selected @endif>Pending</option>
            <option value="cancelled" @if('cancelled' == old('cancelled', $order->status)) selected @endif>Cancelled</option>
            <option value="processing" @if('processing' == old('processing', $order->status)) selected @endif>Processing</option>
            <option value="shipped" @if('shipped' == old('shipped', $order->status)) selected @endif>Shipped</option>
            <option value="completed" @if('completed' == old('completed', $order->status)) selected @endif>Completed</option>
          </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">{{$button}}</button>
