@extends('admin.layouts.master')

@section('title', 'User List Page')

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
                                    <h2 class="title-1">User List</h2>
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
                                <form action="{{ route('admin#userList') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark ms-1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('admin#userList') }}" class="ms-1">
                                            <button type="button" class="btn btn-dark">Reset</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-2 bg-white shadow-sm mb-3 p-2 text-center">
                            <h4>Total - {{ $users->total() }}</h4>
                        </div>

                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
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
                                    <tbody id="dataList">
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="col-1">
                                                    @if($user->image == null)
                                                        <img src="{{ asset('image/default-user-image.png') }}" alt="default_user" class="shadow-sm mt-3">
                                                    @else
                                                        <img src="{{ asset('storage/'.$user->image) }}" alt="user_profile" class="shadow-sm mt-3">
                                                    @endif
                                                </td>
                                                <input type="hidden" id="userId" value="{{ $user->id }}">
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>
                                                    <select class="form-control statusChange">
                                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </td>
                                                <td class="">
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('admin#userDelete', $user->id) }}">
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
                                    {{ $users->links() }}
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
        $(document).ready(function() {
            // role change
            $('.statusChange').change(function () {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'userId': $userId,
                    'role': $currentStatus
                }

                $.ajax({
                    type : "GET",
                    url : '/user/change/role',
                    data : $data,
                    dataType : "json",
                })

                location.reload();
            })
        })
    </script>
@endsection



