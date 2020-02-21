@extends('layouts.app')

@section('content')
<div class="col-sm-12">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <h3>Articles</h3>
            <a href="{{route('article-form')}}" class="btn btn-primary">Add new article</a>
            <hr>
            <div class="table-responsive">
                <table class='table table-stripped table-hover'>
                    <thead>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Content')}}</th>
                        <th>{{__('Author')}}</th>
                        <th>{{__('Category')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Control')}}</th>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            
                            <tr>
                                <td>{{$article->title}}</td>
                                <td>{{\Illuminate\Support\Str::limit($article->content, 30, $end='....')}}<a href="{{route('show-article', ['id'=>$article->id])}}">Read more</a></td>
                                <td>{{$article->user->name}}</td>
                                <td>{{$article->category->name}}</td>
                                <td>{{$article->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('edit-article', ['id' => $article->id])}}"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete-article', ['id' => $article->id])}}" class="btn btn-danger"><i class="fa fa-trash" onclick="if(!confirm('Are you sure?')) return false;"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$articles->render()}}
            </div>
        </div>
    </div>
</div>

@endsection