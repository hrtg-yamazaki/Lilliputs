@extends('layout')


@section("top-wrapper")

    <div class="top-wrapper">
        <div class="top-wrapper__box">
            <h1 class="top-wrapper__box__text">
                Leave dishes to Luck.
            </h1>
        </div>
    </div>

@endsection


@section('content')

    <div class="content">
        <div class="content__box">

            <ul>
                @foreach($recipes as $recipe)
                    <li>
                        <a href={{ route('root') }}>
                            {{ $recipe->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @auth
                <p>{{ $user->name }}</p>
            @endauth

        </div>
    </div>

@endsection
