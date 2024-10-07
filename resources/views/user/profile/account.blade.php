@extends('user.layouts.master')

@section('content')
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
                                    <h3 class="text-center title-2">Account Profile</h3>
                                </div>
                                <hr>

                                @if(session('changeSuccess'))
                                    <div class="col-4 offset-8">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-circle-check"></i> {{ session('changeSuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            @if(Auth::user()->image == null)
                                                <img src="{{ asset('image/default-user-image.png') }}" alt="default_user" class="img-thumbnail shadow-sm mt-3">
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="user_profile" class="img-thumbnail shadow-sm mt-3">
                                            @endif

                                            <div class="mt-3">
                                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
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
                                                <input id="cc-pament" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name...">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" type="text" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email...">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Phone</label>
                                                <input id="cc-pament" name="phone" type="text" value="{{ old('phone', Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone...">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Gender</label>
                                                <select name="gender" id="cc-pament" class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Choose gender...</option>
                                                    <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                                    <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Address</label>
                                                <textarea name="address" id="cc-pament" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Your Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Role</label>
                                                <input id="cc-pament" name="role" type="text" value="{{ old('role', Auth::user()->role) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
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
@endsection
