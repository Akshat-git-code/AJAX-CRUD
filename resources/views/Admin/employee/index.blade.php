@extends('admin.layouts.master')
@section('title','List | Employee')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><i class="fas fa-list"></i> Employees list</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{route('user.create')}}">
            <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New Employee</button>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="searchTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Created date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $j=1 @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{$j++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{ date('d F Y', strtotime($user->dob)) }}</td>
                        <td>{{ $user->created_at->format('d F Y') }}</td>
                        <td>
                            <a class="btn btn-info btn-link btn-sm" href="{{ route('user.edit',$user) }}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                            <form action="{{route('user.destroy',$user)}}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete...?');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
