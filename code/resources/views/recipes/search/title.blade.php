@extends('layout')


@section('content')

    <div class="search-wrapper">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head">
                    タイトル検索
                </h2>
                <div class="search-contents__box__content">

                    {{ Form::open(["method"=>"get", "route" => "recipes.search.title", "class"=>"search-form"]) }}
                        {{ Form::text("title", null, ["class"=>"search-form__input", "placeholder"=>"キーワードを入力してください"]) }}
                        {{ Form::submit("検索", ["class"=>"search-form__submit"]) }}
                    {{ Form::close() }}

                    <p class="half-border"></p>

                    @isset($recipes)
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
                    @endisset

                </div>
            </div>
        </div>

    </div>

@endsection