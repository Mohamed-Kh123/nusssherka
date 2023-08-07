@extends('layouts.store')
@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="panner">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('assets/slider.jpg')}}" alt="Image 1">
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <hr>
                <h2 style="color: #f03455;">{{trans('lang.categories')}}</h2>
            </div>
        </div>

        <div class="row p-2">
            @foreach($categories as $category)
                <div class="col-md-4 col-6 p-2">
                    <div class="card">
                        @if(_get($category, 'products_count') > 0)
                            <a href="{{route('category.show', _get($category, 'slug'))}}"><img
                                    src="{{ _get($category, 'image') }}" class="card-img-top" alt="Category 6"></a>
                        @else
                            <button type="button" class="modal-btn-img" data-bs-toggle="modal"
                                    data-bs-target="#{{ _get($category, 'slug') }}">
                                <img src="{{ _get($category, 'image') }}" class="card-img-top" alt="Category 6">
                            </button>
                        @endif
                        <div class="modal fade" id="{{ _get($category, 'slug') }}" data-bs-backdrop="static"
                             data-bs-keyboard="false"
                             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <form class="form modal-content" id="form" action="{{ route('checkout.store') }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5"
                                            id="staticBackdropLabel">{{ _get($category, 'name') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group" id="append-form">
                                            @if (getFormBySlug(_get($category, 'slug')))
                                                @include('front.forms.' . _get($category, 'slug'), [
                                                    'type' => _get($category, 'slug'),
                                                    'total' => _get($category, 'price', 0)
                                                ])
                                            @else
                                                @include('front.forms.default', [
                                                   'total' => _get($category, 'price', 0),
                                                   'type' => _get($category, 'slug', 0),
                                               ])
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="purchase btn" type="submit">اتمام عملية الدفع</button>
                                        <button type="button" class="btn dismiss" data-bs-dismiss="modal">إلغاء
                                            الأمر
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <hr>
                <h2 style="color: #f03455;">{{trans('lang.nuss_bundles')}}</h2>
            </div>
        </div>
        <div class="grid-3">
            <div class="bundle">
                <img src="{{asset('assets/slider.jpg')}}">
            </div>
            <div class="bundle"></div>
            <div class="bundle"></div>
        </div>
    </div>
@endsection

