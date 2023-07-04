@extends('layouts.store')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                    <li class="active">{{__('About Us')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- about wrapper start -->
    <div class="about-us-wrapper pt-60 pb-40">
        <div class="container">
            <div class="row">
                <!-- About Text Start -->
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="about-text-wrap">
                        <h2><span>{{$aboutUs->title}}</span></h2>
                        <p>{{$aboutUs->content}}</p>
                    </div>
                </div>
                <!-- About Text End -->
                <!-- About Image Start -->
                <div class="col-lg-5 col-md-10">
                    <div class="about-image-wrap">
                        <img class="img-full" src="{{ asset('storage/'.$aboutUs->image_path) }}"
                            alt="About Us" />
                    </div>
                </div>
                <!-- About Image End -->
            </div>
        </div>
    </div>
    <!-- about wrapper end -->
@endsection
