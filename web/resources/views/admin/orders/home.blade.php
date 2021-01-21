@extends('adminlte::page')

@section('content')
    @include('shared.search')
    <x-messages/>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Manage Orders') }}</h3>
                        <div class="box-tools">
                        </div>
                    </div>
                    <div class="box-header with-border margin15">
                        <form action="{{ route('orders.index') }}" method="GET" class="form-inline">
                            <div class="form-row">
                                <div class="col-auto my-1">
                                    <input id="search_product" type="text" value="{{ request()->get('name') }}" name="name" class="form-control" placeholder="{{ __('Product Name') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <input id="search_email" type="text" value="{{ request()->get('email') }}" name="email" class="form-control" placeholder="{{ __('Email') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <input id="search_firstname" type="text" value="{{ request()->get('firstname') }}" name="firstname" class="form-control" placeholder="{{ __('First name') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <input id="search_lastname" type="text" value="{{ request()->get('lastname') }}" name="lastname" class="form-control" placeholder="{{ __('Last name') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <select name="type" class="custom-select mr-sm-2">
                                        <option value="">{{ __('Transaction type ') }}</option>
                                        <option value="{{ $orderTypes[1] }}" {{ request()->get('type') == $orderTypes[1]? "selected" : '' }}>{{ __('Paypal') }}</option>
                                        <option value="{{ $orderTypes[2] }}" {{ request()->get('type') == $orderTypes[2]? "selected" : '' }}>{{ __('Credit card') }}</option>
                                    </select>
                                </div>
                                <div class="col-auto my-1">
                                    <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th class="width280">{{ __('Actions') }}</th>
                            </tr>
                            @if (count($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->transaction_type == $orderTypes[1]? 'PayPal' : 'Credit card' }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->order_total }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                                <a href="{{ route('orders.show', ['order' => $item]) }}" type="button" class="btn btn-success btn-sm width80">
                                                <i class="far fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm width80" data-toggle="modal" data-target="#delete-entity"
                                                    data-url="{{ route('orders.destroy', ['order' => $item]) }}" >
                                                    <i class="far fa-trash-alt"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">{{ __('No active orders') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $data->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('shared.entityModal')
@endsection