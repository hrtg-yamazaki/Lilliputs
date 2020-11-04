@extends('layout')


@section('content')

    <div class="search-wrapper">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head">
                    レシピ候補
                </h2>
                <div class="search-contents__box__content">

                    <div class="category-search">
                        {{ $maingred_id." & ".$method_id }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection