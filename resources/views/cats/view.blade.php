@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <h3>Categories</h3>
            <div class="table-responsive">
                <a href="{{url('/cats/create')}}" class="btn btn-primary">Add new category</a>
                <hr>
                <table class='table table-hover'>
                    <thead>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Articles no.')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Control')}}</th>
                    </thead>
                    <tbody>
                        @foreach($cats as $cat)
                            <tr>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->articles->count()}}</td>
                                <td>{{$cat->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('edit-cat', ['id' => $cat->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete-cat', ['id' => $cat->id])}}" class="btn btn-danger"><i class="fa fa-trash" onclick="if(!confirm('Are you sure?')) return false;"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$cats->render()}}
            </div>
        </div>
    </div>
</div>

@endsection