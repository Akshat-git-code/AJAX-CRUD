@extends('admin.layouts.master')
@section('title','Edit | Profile')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-edit"></i> Edit Profile</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <span class="text-danger">*</span> {{ $errors->first() }}
                    </div>
                @endif
                <form method="post" action="{{ auth()->user()->role === 'Admin' ? route('profile-update'): route('emp-profile-update') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label class="bmd-label-floating">Name <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name',auth()->user()->name)}}">
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating">Email <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email',auth()->user()->email)}}">
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating">Phone <i class="text-danger">*</i></label>
                            <input type="number" class="form-control" name="phone" value="{{ old('phone',auth()->user()->phone)}}" min="1">
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating">DOB <i class="text-danger">*</i></label>
                            <input type="date" class="form-control" name="dob" value="{{ old('dob',auth()->user()->dob)}}"  >
                        </div>

                        <button type="submit" id="btn" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                        <h4 class="pt-2"><i class="fa fa-edit"></i> Change Password</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ auth()->user()->role === 'Admin' ? route('changepassword'):route('emp-changepassword') }}"  method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Current Password<i class="text-danger">*</i></strong>
                                                <input type="password" name="current_password" placeholder="Current Password" value="{{ old('current_password')}}" class="form-control">
                                                @error('current_password')
                                                    <span class="text-danger">*{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>New Password<i class="text-danger">*</i></strong>
                                                <input type="password" name="new_password" placeholder="New Password" value="{{ old('new_password')}}" class="form-control">
                                                @error('new_password')
                                                    <span class="text-danger">*{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Confirm New Password<i class="text-danger">*</i></strong>
                                                <input type="password" name="confirm_password" placeholder="Confirm New Password" value="{{ old('confirm_password')}}" class="form-control">
                                                @error('confirm_password')
                                                    <span class="text-danger">*{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary col-md-12">Change password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
