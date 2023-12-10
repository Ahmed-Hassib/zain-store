@extends('layouts.app')

@section('page-title', __('home.home'))

@push('stylesheets')
<link rel="stylesheet" type="text/css"
    href="{{asset('layout/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" type="text/css"
    href="{{asset('layout/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
@endpush

@section('content')
<div class="card-box pd-20 height-100-p mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="{{asset('layout/vendors/images/banner-img.png')}}" alt="" />
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                {{__('home.welcome back')}}
                <div class="weight-600 font-30 text-blue">{{Auth::User()->name}}</div>
            </h4>
            <p class="font-18 max-width-600">
                {{__('home.welcome msg')}}
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('layout/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('layout/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('layout/vendors/scripts/dashboard.js')}}"></script>
@endpush