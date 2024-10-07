@extends('admin.layouts.master')

@section('title', 'Product List Page')

@section('content')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Product List</h2>
                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('products#createPage') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Product
                                    </button>
                                </a>
                            </div>
                        </div>

                        @if(session('deleteSuccess'))
                            <div class="col-5 offset-7">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-3 mt-1">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                            </div>
                            <div class="col-5 offset-4">
                                <form action="{{ route('products#list') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark ms-1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('products#list') }}" class="ms-1">
                                            <button type="button" class="btn btn-dark">Reset</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 bg-white shadow-sm mb-3 p-2 text-center">
                                <h4>Total - {{ $pizzas->total() }}</h4>
                            </div>
                        </div>


                            @if (count($pizzas) != 0)
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>View Count</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pizzas as $p)
                                                <tr class="tr-shadow text-center">
                                                    <td class="col-3"><img src="{{ asset('storage/'.$p->image) }}" class=" img-thumbnail shadow-sm"></td>
                                                    <td class="col-3">{{ $p->name }}</td>
                                                    <td class="col-2">{{ $p->category_name }}</td>
                                                    <td class="col-3">{{ $p->price }} kyats</td>
                                                    <td class="col-2"><i class=" fa-solid fa-eye"></i> {{ $p->view_count }}</td>
                                                    <td class="col-2">
                                                        <div class="table-data-feature">
                                                            <a href="{{ route('products#edit', $p->id) }}">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                                    <i class=" fa-solid fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('products#updatePage', $p->id) }}">
                                                                <button class="item ms-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('products#delete', $p->id) }}">
                                                                <button class="item ms-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="mt-3">
                                    {{ $pizzas->links() }}
                                </div>
                            </div>
                            @else
                                <h3 class="text-secondary text-center mt-5">There is no product here!</h3>
                            @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection


