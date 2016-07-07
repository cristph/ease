@extends('main')

@section('content')
    <h1>About</h1>

    @if(count($peoples))
        <h3>People I Like:</h3>
        <ul>
            @foreach ($peoples as $person)
                <li>{{ $person }}</li>
            @endforeach
        </ul>
    @endif

@endsection