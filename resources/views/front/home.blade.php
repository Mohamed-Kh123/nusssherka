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
                    <a href="{{route('category.show', $category->slug)}}"><img src="{{ $category->image }}" class="card-img-top" alt="Category 6"></a>
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

@section('modal_area')
    <div class="modal fade modal-wrapper" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area row">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/1.jpg') }}"
                                             alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/2.jpg') }}"
                                             alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/3.jpg') }}"
                                             alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/4.jpg') }}"
                                             alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/5.jpg') }}"
                                             alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/6.jpg') }}"
                                             alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/1.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/2.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/3.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/4.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/5.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/6.jpg') }}"
                                            alt="product image thumb"></div>
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2></h2>
                                    <span class="product-details-ref">Reference: demo_15</span>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                            <li class="review-item"><a href="#">Write Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">$</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Dimension</label>
                                            <select class="nice-select">
                                                <option value="">...</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add
                                            to wishlist</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i
                                                            class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a href="#"><i
                                                            class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a href="#"><i
                                                            class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a href="#"><i
                                                            class="fa fa-instagram"></i>Instagram</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
