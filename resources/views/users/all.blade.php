@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <h3>All Users</h3>
            <div class="table-responsive">
                <table class='table table-bordered table-hover'>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Owner (True/False)</th>
                        <th>Control</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->hasRole('owner')}}</td>
                                <td>
                                    <a href="{{url('user/edit/'.$user->id)}}"><i class="fa fa-2x fa-edit"></i></a>
                                    <a href="{{url('user/delete/'.$user->id)}}"><i class="fa fa-2x fa-trash" onclick="if(!confirm('Are you sure?')) return false;"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->render()}}
            </div>
            <div class="alert alert-info">
                *Owner: Can edit/delete users
            </div>
        </div>
    </div>
</div>

@endsection