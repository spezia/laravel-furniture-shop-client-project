@extends('adminlte::page')

@section('title', __('View Page'))

@section('content')

    <x-messages/>

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
       <div class="row">
           <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('View Page') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.pages.form-fields')
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('pages.index') }}" type="button" class="btn btn-danger btn-sm width80">{{ __('Back') }}</a>
                    </div>
                </div>
           </div>
       </div>
   </section>
   <!-- /.content -->
   @include('shared.entityModal')
@endsection