@extends('adminlte::page')

@section('title', __('View Order'))

@section('content')

    <x-messages/>

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
       <div class="row">
           <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('View Order') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <hr/>
                                <h3>User info</h3>
                                <div class="form-group">
                                    <label>{{ __('First name') }}</label>
                                    <input type="text" value="{{ $order->firstname }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Last name') }}</label>
                                    <input type="text" value="{{ $order->lastname }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="text" value="{{ $order->email }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" value="{{ $order->phone }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" value="{{ $order->address }}" class="form-control" disabled>
                                </div>

                                <hr/>
                                <h3>Payment Info</h3>
                                <div class="form-group">
                                    <label>{{ __('Transaction type') }}</label>
                                    <input type="text" value="{{ ($order->transaction_type == 'paypal') ? 'PayPal' : 'Credit card' }}" class="form-control" disabled>
                                </div>
                                @foreach ($order->transaction_properties_array as $key => $item)
                                    <div class="form-group">
                                        <label>{{ ucfirst($key) }}</label>
                                        <input type="text" value="{{ $item }}" class="form-control" disabled>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label>{{ __('Total') }} ({{ \config('custom.currency') }})</label>
                                    <input type="text" value="{{ $order->order_total }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Creation order') }}</label>
                                    <input type="text" value="{{ $order->created_at }}" class="form-control" disabled>
                                </div>

                                <hr/>
                                <h3>Products</h3>
                                @foreach ($order->orderItems as $key => $item)
                                    <div class="form-group">
                                        <label>{{ __('Product name') }}</label>
                                        <input type="text" value="{{ $item->name }}" class="form-control" disabled>
                                    </div>
                            
                                    <div class="position-relative margin-top20 row">
                                        <div class="col-2">
                                            <label>{{ __('image') }}</label>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ $item->product->single_image }}" data-toggle="lightbox">
                                                <img src="{{ $item->product->single_image_small }}" class="img-fluid img-circle">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Product price') }}</label>
                                        <input type="text" value="{{ $item->price }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Quantity') }}</label>
                                        <input type="text" value="{{ $item->quantity }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Total per product') }}</label>
                                        <input type="text" value="{{ $item->total }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Product properties') }}</label>
                                        @forelse($item->properties_array as $property)
                                            <p>{{ ucfirst($property) }}</p>
                                        @empty
                                        @endforelse
                                    </div>
                                    @if(!$loop->last)
                                        <hr/>
                                    @endif
                                @endforeach
                            </div>
                        </div>    
                        
                    </div>
                    <div class="box-footer margin-top20">
                        <a href="{{ route('orders.index') }}" type="button" class="btn btn-danger btn-sm width80">{{ __('Back') }}</a>
                    </div>
                </div>
           </div>
       </div>
   </section>
   <!-- /.content -->
   @include('shared.entityModal')
@endsection