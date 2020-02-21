@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-11">
                        <h3>All roles</h3>
                    </div>
                    <a href="{{route('create-role')}}" class="btn btn-primary">Add role</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class='table table-hover'>
                    <thead>
                        <th>Name</th>
                        <th>Display name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Control</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->display_name}}</td>
                                <td>{{$role->description}}</td>
                                <td>{{$role->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="#" class="btn btn-primary"><i class="fa fa-edit fa-x"></i></a> 
                                    <a href="{{url('/role/del/'.$role->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete? ') ? true : false"><i class="fa fa-trash fa-x"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$roles->render()}}
            </div>
        </div>
    </div>
</div>

@endsection