@extends('layout')


@section('content')

    <div class="show-sections">

        <div class="show-section">
            <div class="show-section__box">
                <div class="show-head clearfix">
                    <div class="show-head__left">
                        <div class="show-no-image">
                            No image
                        </div>
                    </div>
                    <div class="show-head__right">
                        <div class="show-title">
                            <h2 class="show-title__text">{{ $recipe->title }}</h2>
                            <div class="show-link">
                                @auth
                                    @if($recipe->user_id == Auth::user()->id)
                                        <a href={{ route("recipes.edit", ['recipe' => $recipe]) }} class="show-link__edit">
                                            編集
                                        </a>
                                        <a href={{ route("recipes.destroy_confirm", ['recipe' => $recipe]) }} class="show-link__destroy">
                                            削除
                                        </a>
                                    @else
                                        @if($recipe->user_id)
                                            <p class="show-link__user">
                                                投稿者：{{ $recipe->user->name }} さん
                                            </p>
                                        @endif
                                    @endif
                                @else
                                    @if($recipe->user_id)
                                        <p class="show-link__user">
                                            投稿者：{{ $recipe->user->name }} さん
                                        </p>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <p class="show-category">
                            Maingred × Method
                        </p>
                        <p class="half-border">&nbsp;</p>
                        <p class="show-description">
                            &nbsp;&nbsp;{{ $recipe->description }}
                        </p>
                        <p class="half-border">&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="show-section section-wheel">
            <div class="show-section__box">
                <div class="ingredients">
                    <h2 class="ingredients__head">
                        必要なもの
                    </h2>
                    <div class="ingredients__content">
                        <ul class="ingredient-list">

                            @foreach($recipe->ingredients as $ingredient)
                                @include("shared.ingredient")
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="show-section section-wheel">
            <div class="show-section__box">
                <div class="ways">
                    <h2 class="ways__head">
                        作り方
                    </h2>
                    <ul class="ways__content">
                        <li class="way-to-cook clearfix">
                            <h3 class="way-number">1. </h3>
                            <h4 class="way-text">
                                調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。
                            </h4>
                        </li>
                        <li class="way-to-cook clearfix">
                            <h3 class="way-number">2. </h3>
                            <h4 class="way-text">
                                調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。
                            </h4>
                        </li>
                        <li class="way-to-cook clearfix">
                            <h3 class="way-number">3. </h3>
                            <h4 class="way-text">
                                調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。
                            </h4>
                        </li>
                        <li class="way-to-cook clearfix">
                            <h3 class="way-number">4. </h3>
                            <h4 class="way-text">
                                調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。調理手順のサンプル。
                            </h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection
