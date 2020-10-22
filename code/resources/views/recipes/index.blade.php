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

    <div class="index-sections">

        <div class="index-section">
            <div class="index-section__box">
                <h1 class="index-section__box__head">
                    最新の投稿
                </h1>
                <div class="index-section__box__content">
                    <ul class="recipe-list">
                        @if ($recipes)
                            @foreach($recipes as $recipe)

                                @include("shared.recipe_panel")

                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        @auth
            <p>{{ $user->name }}</p>
        @endauth

    </div>

@endsection
