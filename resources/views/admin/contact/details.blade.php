@extends('admin.layouts.master')

@section('title', 'Contact Info')

@section('content')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="ms-3 btn">
                                    <i class="fa-solid fa-arrow-left-long fs-4" onclick="history.back()"></i>
                                </div>
                                <div class="card-title">
                                    <h2 class="text-center title-2">Contact Info</h2>
                                </div>
                                <hr>
                                <div class="row">
                                    <span class="col-10 offset-1">
                                        <h4 class="mb-4 text-end"> {{ $contact->created_at->format('d-F-Y') }}</h4>
                                        <h4 class="mb-4"><i class="fa-solid fa-user me-3"></i> <span class="me-1">-</span> {{ $contact->name }}</h4>
                                        <h4 class="mb-5"><i class="fa-solid fa-at me-3"></i> <span class="me-1">-</span> {{ $contact->email }}</h4>
                                        <h3 class="mb-4 border border-dark rounded p-3 text-justify">{{ $contact->subject }}</h3>
                                        <p class="fs-5 border border-dark rounded p-3 text-justify">{{ $contact->message }}</p>
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
