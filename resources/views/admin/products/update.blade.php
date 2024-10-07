@extends('admin.layouts.master')

@section('title', 'Product Page')

@section('content')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="ms-5 btn">
                                    <i class="fa-solid fa-arrow-left-long fs-4" onclick="history.back()"></i>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Edit Product</h3>
                                </div>
                                <hr>

                                <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                            <img src="{{ asset('storage/'. $pizza->image) }}" alt="default_user" class="img-thumbnail shadow-sm mt-3">

                                            <div class="mt-3">
                                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                                @error('pizzaImage')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-dark col-12">
                                                    Update <i class="fa-solid fa-circle-chevron-right ms-1"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row col-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName', $pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                                @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea name="pizzaDescription" id="cc-pament" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Product Description...">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                                @error('pizzaDescription')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                                <select name="pizzaCategory" id="cc-pament" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                    <option value="">Choose Product Category...</option>
                                                    @foreach($category as $c)
                                                        <option value="{{ $c->id }}" @if($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('pizzaPrice', $pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Price...">
                                                @error('pizzaPrice')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" type="text" value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Waiting Time...">
                                                @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">View</label>
                                                <input id="cc-pament" name="viewCount" type="number" value="{{ old('viewCount', $pizza->view_count) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                                <input id="cc-pament" name="created_at" type="text" value="{{ old('created_at', $pizza->created_at->format('d-F-Y')) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection
