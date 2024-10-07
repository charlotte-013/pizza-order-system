@extends('admin.layouts.master')

@section('title', 'Contact List Page')

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
                                    <h2 class="title-1">Contact List</h2>
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
                                <form action="{{ route('admin#contactList') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark ms-1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('admin#contactList') }}" class="ms-1">
                                            <button type="button" class="btn btn-dark">Reset</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 bg-white shadow-sm mb-3 p-2 text-center">
                                <h4>Total - {{ $contacts->total() }}</h4>
                            </div>
                        </div>

                        @if (count($contacts) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr class="text-center">
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr class="tr-shadow text-center">
                                                <td></td>
                                                <td class="col-2">{{ $contact->name }}</td>
                                                <td class="col-2">{{ $contact->email }}</td>
                                                <td class="col-2">{{ Str::words($contact->subject, 5, '...') }}</td>
                                                <td class="col-3">{{ Str::words($contact->message, 5, '...') }}</td>
                                                <td class="col-2">{{ $contact->created_at->format('d-F-Y') }}</td>
                                                <td class="col-1">
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('admin#contactDetails', $contact->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#contactDelete', $contact->id) }}">
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
                                    {{ $contacts->links() }}
                                </div>
                            </div>
                        @else
                            <h3 class="text-secondary text-center mt-5">There is no contact here!</h3>
                        @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection


