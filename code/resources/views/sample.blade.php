@extends('layout')


@section('content')

    <h1 class="sample">{{ $message }}</h1>

    @auth
        <p>{{ $user->name }}</p>
    @endauth

@endsection
