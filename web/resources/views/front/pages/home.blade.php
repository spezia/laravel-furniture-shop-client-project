@extends('layouts.app')

@section('title', __('Home'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ __('Home') }}
    </h1>
</section>

@include('shared.messages')

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Home</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-12">
                        <div class="js-review-response alert alert-success margin-top20 no-borders">
                        </div>
                        <div class="js-review-error-response alert alert-danger margin-top20 no-borders">
                        </div>
                    </div>
                    <h3 class="box-title">Add review</h3>
                    {{-- // AJAX SCHULD WORK HERE --}}
                    <form id="reviewform" data-url="{{ url(app()->getLocale().'/product/kitchen-table/review') }}">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input id="name" type="text" value="" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <input id="email" type="text" value="" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Comment') }}</label><br/>
                            <textarea name="comment" class="form-control" ></textarea>
                        </div>
                        <div class="form-group">
                            <button id="review-submit" class="btn btn-primary btn-sm width80">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
