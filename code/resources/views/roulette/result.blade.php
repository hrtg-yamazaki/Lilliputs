@extends('layout')


@section('content')

    <div class="search-wrapper">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head search-head-small">
                    レシピ【{{ $maingred->name." × ".$method->name }}】
                </h2>
                <div class="search-contents__box__content">

                    <div class="category-search">
                        @if(count($recipes) > 0)
                            <div class="search-result">
                                <p class="search-result__message">
                                    レシピの候補 ( {{ count($recipes) }} 件 )
                                </p>
                                <ul class="recipe-list">
                                    @if ($recipes)
                                        @foreach($recipes as $recipe)
            
                                            @include("shared.recipe_panel")
            
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @else
                            <div class="search-result">
                                <p class="search-result__message">
                                    現在条件にマッチするレシピはありません
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection