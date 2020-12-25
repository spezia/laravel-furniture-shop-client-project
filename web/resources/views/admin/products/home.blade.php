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
                        <h3 class="box-title">{{ __('Manage Products') }}</h3>
                        <div class="box-tools">
                            <a href="{{ route('products.create') }}" type="button" class="btn btn-sm btn-block btn-success">
                                <i class="fa fa-fw fa-plus"></i> {{ __('Add new') }}
                            </a>
                        </div>
                    </div>
                    <div class="box-header with-border margin15">
                        <form action="{{ route('products.index') }}" method="GET" class="form-inline">
                            <div class="form-row">
                                <div class="col-auto my-1">
                                    <input id="search_product" type="text" value="{{ request()->get('name') }}" name="name" class="form-control" placeholder="{{ __('Product Name') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <input id="search_code" type="text" value="{{ request()->get('code') }}" name="code" class="form-control" placeholder="{{ __('Code') }}">
                                </div>
                                <div class="col-auto my-1">
                                    <select name="category" class="custom-select mr-sm-2">
                                        <option value="">{{ __('Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request()->get('category') == $category->id? "selected" : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto my-1">
                                    <select name="status" class="custom-select mr-sm-2">
                                        <option value="">{{ __('Status') }}</option>
                                        <option value="1" {{ request()->get('status') == '1'? "selected" : '' }}>{{ __('Enabled') }}</option>
                                        <option value="0" {{ request()->get('status') == '0'? "selected" : '' }}>{{ __('Disabled') }}</option>
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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Slug') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="width280">{{ __('Actions') }}</th>
                            </tr>
                            @if (count($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td> @include('shared.status', ['item' => $item])</td>
                                        <td class="text-center">
                                                <a href="{{ route('products.show', ['product' => $item]) }}" type="button" class="btn btn-success btn-sm width80">
                                                <i class="far fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('products.edit', ['product' => $item]) }}" type="button" class="btn btn-primary btn-sm width80">
                                                    <i class="fas fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm width80" data-toggle="modal" data-target="#delete-entity"
                                                    data-url="{{ route('products.destroy', ['product' => $item]) }}" >
                                                    <i class="far fa-trash-alt"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">{{ __('No active products') }}</td>
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