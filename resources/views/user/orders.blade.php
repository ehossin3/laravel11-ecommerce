@extends('layouts.app')
@section('content')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }
    </style>
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Orders</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            @if (count($orders) > 0)
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">OrderNo</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Tax</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Status</th>
                                            <th style="width: 180px" class="text-center">Order Date</th>
                                            <th class="text-center">Items</th>
                                            <th style="width: 180px" class="text-center">Delivered On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">000{{ $order->id }}</td>
                                                <td class="text-center">{{ $order->phone }}</td>
                                                <td class="text-center">{{ formatCurrency($order->subtotal) }}</td>
                                                <td class="text-center">{{ formatCurrency($order->tax) }}</td>
                                                <td class="text-center">{{ formatCurrency($order->total) }}</td>

                                                <td class="text-center">
                                                    @if ($order->status === 'ordered')
                                                        <span
                                                            class="badge bg-warning">{{ strtoupper($order->status) }}</span>
                                                    @elseif ($order->status === 'delivered')
                                                        <span
                                                            class="badge bg-success">{{ strtoupper($order->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger">{{ strtoupper($order->status) }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $order->created_at->format('Y-M-d h:i A') }}
                                                </td>
                                                <td class="text-center">{{ $order->orderItems->count() }}</td>
                                                <td>{{ $order->delivered_date ? $order->delivered_date : 'N/A' }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('user.order-details', $order->id) }}">
                                                        <div class="list-icon-function view-icon">
                                                            <div class="item eye">
                                                                <i class="fa fa-eye"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h5 class="text-center text-dark">{{ __('No Orders Found') }}</h5>
                            @endif
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
