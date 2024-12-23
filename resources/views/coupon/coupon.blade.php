@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap overflow-auto">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupons</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Coupons</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('coupon.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        @if (count($coupons) > 0)
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Cart Value</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->id }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->type }}</td>
                                            <td>{{ $coupon->value }}</td>
                                            <td>{{ $coupon->cart_value }}</td>
                                            <td>{{ $coupon->expire_date }}</td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <a href="{{ route('coupon.edit', $coupon->id) }}">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                    <form action="{{ route('coupon.delete') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="item text-danger delete">
                                                            <input type="hidden" name="c_id"
                                                                value="{{ $coupon->id }}">
                                                            <button type="submit" onclick="return confirm('Are You Sure?')"
                                                                class="btn text fs-1"><i class="icon-trash-2"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-dark text-center">{{ __('No Coupons Found') }}</p>
                        @endif
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $coupons->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
