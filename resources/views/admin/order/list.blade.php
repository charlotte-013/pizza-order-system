@extends('admin.layouts.master')

@section('title', 'Order List Page')

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
                                    <h2 class="title-1">Order List</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-3 mt-1">
                                <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                            </div>
                            <div class="col-5 offset-4">
                                <form action="{{ route('order#list') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                        <button type="submit" class="btn btn-dark ms-1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('order#list') }}" class="ms-1">
                                            <button type="button" class="btn btn-dark">Reset</button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <form action="{{ route('order#changeStatus') }}" method="get">
                            @csrf
                            <div class="input-group d-flex mb-4">
                                <div class="input-group-append">
                                    <span class="input-group-text">Total - {{ count($order) }}</span>
                                </div>
                                <select name="orderStatus" class="form-select col-2" id="orderStatus">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending...</option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accepted</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Rejected</option>
                                </select>

                                <button type="submit" class="btn bg-dark text-white">Enter</button>
                            </div>
                        </form>

                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($order as $o)
                                            <tr class="tr-shadow text-center">
                                                <input type="hidden" class="orderId" value="{{ $o->id }}">
                                                <td class="">{{ $o->user_id }}</td>
                                                <td class="">{{ $o->user_name }}</td>
                                                <td class="">{{ $o->created_at->format('F-j-Y') }}</td>
                                                <td class="">
                                                    <a href="{{ route('order#listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                                </td>
                                                <td class="">{{ $o->total_price }} kyats</td>
                                                <td class="">
                                                    <select name="status" class="form-control text-center statusChange">
                                                        <option value="0" @if ($o->status == 0) selected @endif>Pending...</option>
                                                        <option value="1" @if ($o->status == 1) selected @endif>Accepted</option>
                                                        <option value="2" @if ($o->status == 2) selected @endif>Rejected</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $order->links() }}
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
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type: 'GET',
            //         url: '/order/ajax/status',
            //         data: {
            //             'status' : $status,
            //         }
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = '';
            //             for($i = 0; $i < response.length; $i++) {
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = Smonths[$dbDate.getMonth()] + '-' + $dbDate.getDate() + '-' + $dbDate.getFullYear();

            //                 if(response[$i].status == 0) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control text-center statusChange">
            //                             <option value="0" selected>Pending...</option>
            //                             <option value="1">Accepted</option>
            //                             <option value="2">Rejected</option>
            //                         </select>
            //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control text-center statusChange">
            //                             <option value="0">Pending...</option>
            //                             <option value="1" selected>Accepted</option>
            //                             <option value="2">Rejected</option>
            //                         </select>
            //                     `;
            //                 } else if(response[$i].status == 2) {
            //                     $statusMessage = `
            //                         <select name="status" class="form-control text-center statusChange">
            //                             <option value="0">Pending...</option>
            //                             <option value="1">Accepted</option>
            //                             <option value="2" selected>Rejected</option>
            //                         </select>
            //                     `;
            //                 }

            //                 $list += `
            //                     <tr class="tr-shadow text-center">
            //                         <input type="hidden" class="orderId" value="${response[$i].id}">
            //                         <td class="">${response[$i].user_id}</td>
            //                         <td class="">${response[$i].user_name}</td>
            //                         <td class="">${$finalDate}</td>
            //                         <td class="">${response[$i].order_code}</td>
            //                         <td class="">${response[$i].total_price} kyats</td>
            //                         <td class="">${$statusMessage}</td>
            //                     </tr>
            //                 `;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     })
            // })

            // status change
            $('.statusChange').change(function () {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }

                $.ajax({
                    type : "GET",
                    url : '/order/ajax/change/status',
                    data : $data,
                    dataType : "json",
                })

                location.reload();
                // window.location.href = '/order/list';
            })
        })
    </script>
@endsection


