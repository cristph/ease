@extends('main')

@section('content')
    <h1>Articles</h1>
    <hr/>

    @foreach($articles as $article)
        <article>
            <a href="/articles/{{$article->id}}">{{ $article->title }}</a>
        </article>
    @endforeach
@stop