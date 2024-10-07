@extends('admin.layouts.master')

@section('title', 'Admin List Page')

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
                                    <h2 class="title-1">Admin List</h2>
                                </div>
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
                                <form action="{{ route('admin#list') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark ms-1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('admin#list') }}" class="ms-1">
                                            <button type="button" class="btn btn-dark">Reset</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 bg-white shadow-sm mb-3 p-2 text-center">
                                <h4>Total - {{ $admin->total() }}</h4>
                            </div>
                        </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow text-center">
                                            <input type="hidden" class="userId" value={{ $a->id }}>
                                            <td class="col-1">
                                                @if($a->image == null)
                                                    <img src="{{ asset('image/default-user-image.png') }}" alt="default-user">
                                                @else
                                                    <img src="{{ asset('storage/'.$a->image) }}" class=" img-thumbnail shadow-sm">
                                                @endif
                                            </td>
                                            <td class="">{{ $a->name }}</td>
                                            <td class="">{{ $a->email }}</td>
                                            <td class="">{{ $a->gender }}</td>
                                            <td class="">{{ $a->phone }}</td>
                                            <td class="">{{ $a->address }}</td>
                                            <td class="">
                                                @if(Auth::user()->id != $a->id)
                                                    <select class="form-control adminRoleChange">
                                                        <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user">User</option>
                                                    </select>
                                                @endif
                                            </td>
                                            <td class="">
                                                <div class="table-data-feature">
                                                    @if(Auth::user()->id != $a->id)
                                                        <a href="{{ route('admin#delete', $a->id) }}">
                                                            <button class="item ms-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $admin->links() }}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection


@section('scriptSource')
    <script>
        $(document).ready(function () {
            $('.adminRoleChange').change(function () {
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'role': $currentRole,
                    'userId': $userId
                }

                $.ajax({
                    type : "GET",
                    url : '/admin/ajax/change/role',
                    data : $data,
                    dataType : "json",
                })

                location.reload();
            })
        })
    </script>
@endsection


