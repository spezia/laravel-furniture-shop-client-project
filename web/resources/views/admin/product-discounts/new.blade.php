@extends('adminlte::page')

@section('title', __('Discount Add'))

@section('content')

    <x-messages/>

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
       <div class="row">
           <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Add new Discount') }}</h3>
                    </div>
                    <form action="{{ route('product-discounts.store') }}" method="POST" enctype="multipart/form-data">
                        <!-- /.box-header -->
                        <div class="box-body">
                            @csrf
                            @include('admin.product-discounts.form-fields')
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm width80">{{ __('Save') }}</button>
                            <a href="{{ route('product-discounts.index') }}" type="button" class="btn btn-danger btn-sm width80">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
           </div>
       </div>
   </section>
   <!-- /.content -->
   @include('shared.entityModal')
@endsection
