@extends('admin.layouts.master')

@section('title', 'Product Info')

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
                                    <h2 class="text-center title-2">Product Info</h2>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4 offset-1 mt-3">
                                            <img src="{{ asset('storage/'. $pizza->image) }}" alt="product_image" class="img-thumbnail shadow-sm mt-3">
                                    </div>
                                    <span class="col-7">
                                        <h2 class="mb-3">{{ $pizza->name }}</h2>
                                        <span class="mb-3 btn btn-dark"><i class="fa-solid fa-clipboard-list me-2"></i> {{ $pizza->category_name }}</span>
                                        <span class="mb-3 btn btn-dark"><i class="fa-solid fa-money-bill-1-wave me-2"></i> {{ $pizza->price }} kyats</span>
                                        <span class="mb-3 btn btn-dark"><i class="fa-solid fa-clock me-2"></i> {{ $pizza->waiting_time }} mins</span>
                                        <span class="mb-3 btn btn-dark"><i class="fa-solid fa-eye me-2"></i> {{ $pizza->view_count }}</span>
                                        <span class="mb-3 btn btn-dark"><i class="fa-solid fa-user-clock me-2"></i> {{ $pizza->created_at->format('d-F-Y') }}</span>
                                        <p class="mb-3 fs-5">{{ $pizza->description }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection
