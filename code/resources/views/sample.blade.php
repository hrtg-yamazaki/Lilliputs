@extends('layout')


@section('content')

    <h1>{{ $message }}</h1>

    @auth
        <p>{{ $user->name }}</p>
    @endauth

@endsection
