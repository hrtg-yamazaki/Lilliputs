@extends('layout')


@section("top-wrapper")

    <div class="top-wrapper">
        <div class="smoke">
        </div>
    </div>

@endsection


@section('content')

    <div class="content">
        <div class="content__box">

            <h1 class="sample">{{ $message }}</h1>

            @auth
                <p>{{ $user->name }}</p>
            @endauth

        </div>
    </div>

@endsection
