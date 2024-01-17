@extends('site.master')

@section('page-header')
    {{$headerTitle ?? 'سامانه انتشارات'}}
@endsection


@section('content')


    <div class="card bg-transparent shadow-none col-md-12 col-sm-12" style="border:none ">
        <div class="d-flex mb-1 align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-between w-100">
                @if(\Illuminate\Support\Facades\Session::get('fail'))
                    @if(!is_string(\Illuminate\Support\Facades\Session::get('fail')))
                        <div class="alert alert-danger">
                            <ul class="mb-1">
                                @foreach (\Illuminate\Support\Facades\Session::get('fail')->all() as $error)
                                    <li style="direction: rtl;text-align: right">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <h6 class="ml-auto alert alert-danger mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                    @endif
                @endif
                @if(\Illuminate\Support\Facades\Session::get('success'))
                    <h6 class="ml-auto alert alert-success mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                @endif
            </div>
        </div>
        {{$slot}}
    </div>

@endsection
@section('script')
    {{$script ?? ''}}
@endsection

