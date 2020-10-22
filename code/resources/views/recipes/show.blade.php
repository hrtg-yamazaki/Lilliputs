@extends('layout')


@section('content')

    <div class="content">
        <div class="content__box">

            <h1>{{ $recipe->title }}</h1>
            <br>
            <p>{{ $recipe->description }}</p>

        </div>
    </div>

@endsection
