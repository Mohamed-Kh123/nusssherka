@extends('layouts.store')
@section('content')
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Li's Breadcrumb Area End Here -->
        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">Contact Us</h3>
                            <p class="contact-page-message mb-25">{{ $contact->contact_us }}</p>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-fax"></i> Address</h4>
                                <p>{{ $contact->address }}</p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone"></i> Phone</h4>
                                <p>Mobile: {{ $contact->mobile }}</p>
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                <p>{{ $contact->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content pt-sm-55 pt-xs-55">
                            <h3 class="contact-page-title">Tell Us Your Message</h3>
                            <div class="contact-form">
                                @php $user = Auth::user(); @endphp
                                <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                                    @csrf
                                    <x-alert />
                                    <div class="form-group">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input type="text" name="name" value="{{$user->name ?? null}}" id="customername" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email <span class="required">*</span></label>
                                        <input type="email" name="email" value="{{$user->email ?? null}}" id="customerEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" id="contactSubject">
                                    </div>
                                    <div class="form-group mb-30">
                                        <label>Your Message</label>
                                        <textarea name="message" id="contactMessage"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" >send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->
@endsection
