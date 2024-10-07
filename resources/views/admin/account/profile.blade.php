@extends('admin.layouts.master')

@section('title', 'Profile Page')

@section('content')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-5 offset-4 mb-2">
                    @if(session('updateSuccess'))
                        <div class="">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="ms-5 btn">
                                    <i class="fa-solid fa-arrow-left-long fs-4" onclick="history.back()"></i>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account Info</h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 offset-2 mt-3">
                                        @if(Auth::user()->image == null)
                                            <img src="{{ asset('image/default-user-image.png') }}" alt="default_user" class="shadow-sm mt-3">
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="user_profile" class="shadow-sm mt-3">
                                        @endif
                                    </div>

                                    <div class="col-5 offset-1">
                                        <h4 class="mb-3"> <i class="fa-solid fa-user-pen me-2"></i> {{ Auth::user()->name }}</h4>
                                        <h4 class="mb-3"> <i class="fa-solid fa-at me-2"></i> {{ Auth::user()->email }}</h4>
                                        <h4 class="mb-3"> <i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}</h4>
                                        <h4 class="mb-3"> <i class="fa-solid fa-venus-mars"></i></i> {{ Auth::user()->gender }}</h4>
                                        <h4 class="mb-3"> <i class="fa-solid fa-address-card me-2"></i> {{ Auth::user()->address }}</h4>
                                        <h4 class="mb-3"> <i class="fa-solid fa-user-clock me-2"></i> {{ Auth::user()->created_at->format('d-F-Y') }}</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 offset-9 mt-4">
                                        <a href="{{ route('admin#edit') }}">
                                            <button class="btn btn-dark">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection
