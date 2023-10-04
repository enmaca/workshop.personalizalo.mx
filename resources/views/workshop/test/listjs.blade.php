@extends('workshop.test')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">ListJS</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    @livewire('order.table')
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection