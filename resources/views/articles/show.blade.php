@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row justify-content-center">
    <div class="col-sm-1"><a href="{{route('get-articles')}}" class="btn btn-primary">Articles</a></div>
        <div class="col-sm-10">
        <h3>{{$article->title}}</h3>
        <h5 class="text-grey">{{$article->created_at->diffForHumans()}}</h5>
        <h6>{{__('By: ')}} {{$article->user->name}}</h6>
        <hr>

        <p class="lead">
            {{$article->content}}
        </p>

        <hr>
        
        <div class="alert">
            <h5># {{$article->category->name}}</h5>
        </div>
        </div>
    </div>
</div>
@endsection