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
                        <h3 class="box-title">{{ __('Manage Reviews') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>{{ __('Firstname') }}</th>
                                <th>{{ __('Lastname') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="width280">{{ __('Actions') }}</th>
                            </tr>
                            @if (count($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->firstname }}</td>
                                        <td>{{ $item->lastname }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td>
                                            @if($item->status == $accepted) 
                                                <span class="label label-success">{{ __(preg_replace('/_/', ' ', $accepted)) }}</span> 
                                            @else 
                                                <span class="label label-danger">{{ __(preg_replace('/_/', ' ', $review)) }}</span> 
                                            @endif
                                        </td>
                                        <td class="text-center">
                                                <a href="{{ route('reviews.show', ['review' => $item]) }}" type="button" class="btn btn-success btn-sm width80">
                                                <i class="far fa-eye"></i>
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('reviews.edit', ['review' => $item]) }}" type="button" class="btn btn-primary btn-sm width80">
                                                    <i class="fas fa-edit"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm width80" data-toggle="modal" data-target="#delete-entity"
                                                    data-url="{{ route('reviews.destroy', ['review' => $item]) }}" >
                                                    <i class="far fa-trash-alt"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">{{ __('No active reviews') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('shared.entityModal')
@endsection