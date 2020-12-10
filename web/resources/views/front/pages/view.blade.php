@extends('layouts.app')

@section('title', $page->title)

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page->title }}
    </h1>
</section>

<x-messages/>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <p>{{ $page->content }}</p>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection