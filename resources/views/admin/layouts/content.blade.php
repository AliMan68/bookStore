@extends('admin.master')

@section('page-header')
    {{$headerTitle ?? 'سامانه انتشارات'}}
@endsection


@section('content')

    <div class="card bg-transparent shadow-none col-md-12 col-sm-12" style="border:none ">

        <div class="d-flex mb-1 align-items-center justify-content-between">
            {{$action ?? ''}}

            <div class="d-flex align-items-center justify-content-between w-100">

                @if(\Illuminate\Support\Facades\Session::get('fail'))
                    <h6 class=" alert alert-danger mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                @endif
                @if(\Illuminate\Support\Facades\Session::get('success'))
                    <h6 class=" alert alert-success mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                @endif

                    <h5 class="m-0 text-dark ml-auto">{{$title}}</h5>
            </div>
        </div>
        {{$slot}}
    </div>

@endsection
@section('script')
    {{$script ?? ''}}
@endsection
@section('style')
    {{$style ?? ''}}
@endsection

