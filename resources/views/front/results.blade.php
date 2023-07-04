@extends('layouts.store')

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{route('home')}}">Home</a></li>
                <li class="active">results</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('single.product', $product->slug)}}">
                                                    <img src="{{$product->image_url}}" alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{$product->category->name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating rating-with-review-item">
                                                                @for($i=1; $i<=$product->total_ratings; $i++)
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                @endfor
                                                                @for($j = $product->total_ratings+1; $j <= 5; $j++)
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('single.product', $product->slug)}}">{{$product->name}}</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">${{$product->price}}</span>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="" onclick="addToCart({{$product->id}}, {{Auth::id() ?? 'null'}}, event)">Add to cart</a></li>
                                                        <li><a class="links-details" onclick="addToWishList({{$product->id}}, event)"><i class="fa fa-heart-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row">
                                {{ $products->links() }}                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>


@endsection

@section('modal_area')
<div class="modal fade modal-wrapper" id="exampleModalCenter" >
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
                                    <img src="images/product/large-size/1.jpg" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="images/product/large-size/2.jpg" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="images/product/large-size/3.jpg" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="images/product/large-size/4.jpg" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="images/product/large-size/5.jpg" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="images/product/large-size/6.jpg" alt="product image">
                                </div>
                            </div>
                        </div>
                        <!--// Product Details Left -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection