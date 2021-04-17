@extends('admin.layouts.master')
@section('title','Edit | Employee')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('user.index')}}"><i class="fas fa-list"></i> Employees list</a></li>
            <li class="breadcrumb-item" aria-current="page"><i class="fas fa-plus"></i> Edit Employee</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <span class="text-danger">*</span> {{ $errors->first() }}
            </div>
        @endif
        <form id="user_update">
            @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label class="bmd-label-floating">Name <i class="text-danger">*</i></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',$user->name)}}" required>
                </div>

                <div class="form-group">
                    <label class="bmd-label-floating">Email <i class="text-danger">*</i></label>
                    <input type="email" class="form-control" name="email" value="{{ old('email',$user->email)}}" required>
                </div>

                <div class="form-group">
                    <label class="bmd-label-floating">Phone <i class="text-danger">*</i></label>
                    <input type="number" class="form-control" name="phone" value="{{ old('phone',$user->phone)}}" min="1" required>
                </div>

                <div class="form-group">
                    <label class="bmd-label-floating">DOB <i class="text-danger">*</i></label>
                    <input type="date" class="form-control" name="dob" value="{{ old('dob',$user->dob)}}" required>
                </div>

                <button type="button" id="UserUpdate" class="btn btn-primary btn-block">Update</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#UserUpdate').click(function (){
        var id = $("input[name=id]").val();
        var data = $('#user_update').serialize();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url:'/admin/user/'+id,
            data: data,
            success: function(response)
            {
                if(response[0] === 1){
                    $.notify("Employee Updated Successfully!", "success");
                }
                else{
                    console.log('failed');
                }
                setTimeout(function () {
                    window.location.replace('{{ route('user.index')}}');
                }, 2000);
            }
        });
    });
</script>
@endpush
