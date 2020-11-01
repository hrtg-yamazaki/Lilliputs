@extends('layout')


@section('content')

    <div class="search-wrapper">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head">
                    カテゴリ検索
                </h2>
                <div class="search-contents__box__content">

                    {{--  --}}

                    <p class="half-border"></p>

                    @if($recipes)
                        <div class="search-result">
                            <p class="search-result__message">
                                検索結果 ( {{ count($recipes) }} 件 )
                            </p>
                            <ul class="recipe-list">
                                @if ($recipes)
                                    @foreach($recipes as $recipe)
        
                                        @include("shared.recipe_panel")
        
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

@endsection