@extends('single_layout')


@section('content')

    <div class="search-wrapper-single">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head">
                    ルーレット
                </h2>
                <div class="search-contents__box__content">

                    <p class="search-message">
                        今日は「何を」「どうやって」食べる？
                    </p>

                    <p class="half-border"></p>

                    <div class="roulette">
                        <recipe-roulette></recipe-roulette>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection