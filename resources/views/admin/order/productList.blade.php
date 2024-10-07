@extends('admin.layouts.master')

@section('title', 'Order Info Page')

@section('content')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="table-responsive table-responsive-data2">
                            <div class="ms-2 btn">
                                <i class="fa-solid fa-arrow-left-long fs-4" onclick="history.back()"></i>
                            </div>

                            <div class="row col-6">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h3><i class="fa-solid fa-clipboard me-2"></i> Order Info</h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-user me-2"></i> Customer Name</div>
                                            <div class="col"><span class="me-1">-</span> {{ strtoupper($orderList[0]->user_name) }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                            <div class="col"><span class="me-1">-</span> {{ $orderList[0]->order_code }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-regular fa-clock me-2"></i> Order Date</div>
                                            <div class="col"><span class="me-1">-</span> {{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i> Total</div>
                                            <div class="col"><span class="me-1">-</span> {{ $order->total_price }} kyats
                                                <small class="text-danger">(<i class="fa-solid fa-triangle-exclamation"></i> Includes Delivery Charges)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-data2 text-center mt-3">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                    <tbody id="dataList">
                                        @foreach ($orderList as $o)
                                            <tr class="tr-shadow text-center">
                                                <td class="col-2">{{ $o->product_id }}</td>
                                                <td class="col-2"><img src="{{ asset('storage/'. $o->product_image) }}" class="img-thumbnail"></td>
                                                <td class="col-3">{{ $o->product_name }}</td>
                                                <td class="col-1">{{ $o->qty }}</td>
                                                <td class="col-2">{{ $o->total }} kyats</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    <!-- END MAIN CONTENT-->

@endsection



