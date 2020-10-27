@extends('single_layout')


@section('content')

    <div class="form-section">
        <div class="recipe-form">
            <div class="recipe-form__box">
                <h2 class="recipe-form__box__head">
                    新規投稿
                </h2>
                <div class="recipe-form__box__content">
                    {{ Form::open(["route" => "recipes.store", "class"=>"recipe-fields"]) }}
                        {{ csrf_field() }}
                        @if ($errors->any())
                            @include("shared.errors")
                        @endif
                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                {{ Form::label("title", "レシピのタイトル", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::text("title", null, ["class"=>"recipe-field__input__textbox"]) }}
                            </p>
                        </div>
                        <div class="recipe-field extra-padding">
                            <p class="recipe-field__label">
                                {{ Form::label("description", "レシピの簡単な紹介文", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::textarea("description", null, ["class"=>"recipe-field__input__textarea"]) }}
                            </p>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="ingredient-form">
                            <h3 class="ingredient-form__head">
                                必要なもの
                            </h3>
                            <div class="ingredient-form__secondhead clearfix">
                                <h4 class="ingredient-form__secondhead__name">
                                    <label>食材の名前</label>
                                </h4>
                                <h4 class="ingredient-form__secondhead__amount">
                                    <label>数量</label>
                                </h4>
                            </div>
                            @for($i = 0; $i < 10; $i ++)
                                <div class="ingredient-field clearfix">
                                    <p class="ingredient-field__name">
                                        {{ Form::text("ingredients[".$i."][name]", null, ["class"=>"ingredient-field__name__input"]) }}
                                    </p>
                                    <p class="ingredient-field__amount">
                                        {{ Form::text("ingredients[".$i."][amount]", null, ["class"=>"ingredient-field__amount__input"]) }}
                                    </p>
                                </div>
                            @endfor
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-submit">
                            {{ Form::submit('投稿する', ["class"=>"recipe-submit__button"]) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
