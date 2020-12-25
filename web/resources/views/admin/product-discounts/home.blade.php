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
                        <h3 class="box-title">{{ __('Manage Discounts') }}</h3>
                        <div class="box-tools">
                            <a href="{{ route('product-discounts.create') }}" type="button" class="btn btn-sm btn-block btn-success">
                                <i class="fa fa-fw fa-plus"></i> {{ __('Add new') }}
                            </a>
                        </div>
                    </div>
                    <div class="box-header with-border margin15">
                        <form action="{{ route('product-discounts.index') }}" method="GET" class="form-inline">
                            <div class="form-row">
                                <div class="col-auto my-1">
                                    <input id="search_product" type="text" value="{{ request()->get('name') }}" name="name" class="form-control" placeholder="{{ __('Product Name') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <input id="search_discount" type="text" value="{{ request()->get('discount') }}" name="discount" class="form-control" placeholder="{{ __('Discount') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <select name="status" class="custom-select mr-sm-2">
                                        <option value="">{{ __('Status') }}</option>
                                        <option value="active" {{ request()->get('status') == 'active'? "selected" : '' }}>{{ __('Active') }}</option>
                                        <option value="inactive" {{ request()->get('status') == 'inactive'? "selected" : '' }}>{{ __('Not Active') }}</option>
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
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('New Price') }}</th>
                                <th>{{ __('From') }}</th>
                                <th>{{ __('To') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="width280">{{ __('Actions') }}</th>
                            </tr>
                            @if (count($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->price }}</td>
                                        <td>{{ $item->new_price }}</td>
                                        <td>{{ $item->from->format('d.m.Y | H:i:s') }}</td>
                                        <td>{{ $item->to->format('d.m.Y | H:i:s') }}</td>
                                        <td>
                                            @if($item->is_active) 
                                                <span class="label label-success">{{ __('Active') }}</span>
                                            @else 
                                                <span class="label label-danger">{{ __('Not active') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                                <a href="{{ route('product-discounts.show', ['productDiscount' => $item]) }}" type="button" class="btn btn-success btn-sm width80">
                                                <i class="far fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('product-discounts.edit', ['productDiscount' => $item]) }}" type="button" class="btn btn-primary btn-sm width80">
                                                    <i class="fas fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm width80" data-toggle="modal" data-target="#delete-entity"
                                                    data-url="{{ route('product-discounts.destroy', ['productDiscount' => $item]) }}" >
                                                    <i class="far fa-trash-alt"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">{{ __('No discounts') }}</td>
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