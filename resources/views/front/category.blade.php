@extends('layouts.store')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <hr>
                <h2 style="color: #f03455;">{{$category->name}}</h2>
            </div>
        </div>

        <div class="row p-2">
        @foreach($category->products as $product)
            <div class="col-md-3 p-2">
                <div class="card">
                    <a onclick="showForm()"><img src="{{ $product->image_url }}" class="card-img-top" alt="Category 6"></a>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <form class="form" id="form" style="display: none">
        <div class="form-group">
            <label>اسم المؤسسة</label>
            <input type="text" >
        </div>
    </form>

@endsection


@push('script')
    <script>
        function showForm(){
            $('#form').css('display', 'flex')
        }

    </script>
@endpush
