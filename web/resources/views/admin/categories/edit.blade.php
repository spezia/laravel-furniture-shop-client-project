@extends('adminlte::page')

@section('title', __('Category Edit'))

@section('content')

    @include('shared.messages')

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
       <div class="row">
           <div class="col-md-12">
               <div class="box">
                   <div class="box-header with-border">
                       <h3 class="box-title">{{ __('Edit Category') }}</h3>
                   </div>
                   <!-- /.box-header -->
                   <form action="{{ route('categories.update', ['category' => $category]) }}" method="POST">
                        <div class="box-body">
                                @csrf
                                @method('PUT')
                                @include('admin.categories.form-fields')
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm width80">{{ __('Update') }}</button>
                            <a href="{{ route('categories.index') }}" type="button" class="btn btn-danger btn-sm width80">{{ __('Cancel') }}</a>
                        </div>
                   </form>
               </div>
           </div>
       </div>
   </section>
   <!-- /.content -->
   @include('shared.entityModal')
@endsection
