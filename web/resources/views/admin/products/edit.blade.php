@extends('adminlte::page')

@section('title', __('Product Edit'))

@section('content')

    @include('shared.messages')

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
       <div class="row">
           <div class="col-md-12">
               <div class="box">
                   <div class="box-header with-border">
                       <h3 class="box-title">{{ __('Edit Product') }}</h3>
                   </div>
                   <!-- /.box-header -->
                   <form action="{{ route('products.update', ['product' => $product]) }}" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                                @csrf
                                @method('PUT')
                                @include('admin.products.form-fields')
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm width80">{{ __('Update') }}</button>
                            <a href="{{ route('products.index') }}" type="button" class="btn btn-danger btn-sm width80">{{ __('Cancel') }}</a>
                        </div>
                   </form>
               </div>
           </div>
       </div>
   </section>
   <!-- /.content -->
   @include('shared.entityModal')
@endsection
