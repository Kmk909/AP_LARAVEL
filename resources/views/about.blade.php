@extends ('layout')

@section('content')
    <h3>About us</h3>
    @foreach($data as $key=>$value)
    {{$key .'='.$value}}
    @endforeach
@endsection