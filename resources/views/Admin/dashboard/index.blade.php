@extends('admin.layouts.master')
@section('title','Admin | Dashboard')
@section('main-content')
@if(auth()->user()->role === "Admin")
    <div class="row ">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <a href="{{ route('user.index')}}">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                <h5 class="font-15">Total Employee</h5>
                                <h2 class="mb-3 font-18">{{ $emp_total }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                <img src="{{ asset('assets/img/banner/1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6>Today's Birthday</h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="searchTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $j=1 @endphp
                                @foreach($users_today as $today)
                                <tr>
                                    <td>{{$j++}}</td>
                                    <td>{{$today->name}}</td>
                                    <td>{{$today->email}}</td>
                                    <td>{{ date('d F Y', strtotime($today->dob)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/send-mail',$today->email)}}" class="btn btn-danger"><i data-feather="mail"></i> Send</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6>This Month Birthday</h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="searchTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $j=1 @endphp
                                @foreach($users_month as $month)
                                <tr>
                                    <td>{{$j++}}</td>
                                    <td>{{$month->name}}</td>
                                    <td>{{$month->email}}</td>
                                    <td>{{ date('d F Y', strtotime($month->dob)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
