@extends('single_layout')


@section('content')

    <div class="form-section">
        <div class="recipe-form">
            <div class="recipe-form__box">
                <h2 class="recipe-form__box__head">
                    新規投稿
                </h2>
                <div class="recipe-form__box__content">
                    {{ Form::open(["route" => "recipes.store", "files"=>"true", "class"=>"recipe-fields"]) }}
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

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                <label class="recipe-field__label__text">メイン食材 と 調理法</label>
                            </p>
                            <div class="recipe_field__input clearfix">
                                <p class="half-field field-left">
                                    {{ Form::select("maingred_id", $maingreds) }}
                                </p>
                                <p class="half-field field-right">
                                    {{ Form::select("method_id", $methods) }}
                                </p>
                            </div>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                <label class="recipe-field__label__text">
                                    料理の画像
                                </label>
                            </p>
                            <div class="recipe_field__input clearfix">
                                {{ Form::file("image", ["class"=>"recipe-field__input__image"]) }}
                            </div>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field extra-padding">
                            <p class="recipe-field__label">
                                {{ Form::label("description", "レシピの説明", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::textarea("description", null, ["class"=>"recipe-field__input__textarea"]) }}
                            </p>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="ingredient-form js-create-ingredients">

                            <create-ingredients></create-ingredients>

                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="process-form js-create-processes">

                            <create-processes></create-processes>
                            {{-- <div class="process-form__box">
                                <h3 class="process-form__box__head">
                                    作り方
                                </h3>
                                <div class="process-form__box__content">
                                    @for($i = 0; $i < 5; $i ++)
                                        <div class="process-field clearfix">
                                            <h4 class="process-field__head">
                                                {{ $i + 1 }}.
                                            </h4>
                                            <p class="process-field__input">
                                                {{ Form::textarea("processes[".$i."][content]", null, ["class"=>"process-field__input__textarea"]) }}
                                            </p>
                                        </div>
                                    @endfor
                                </div>
                            </div> --}}

                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-submit">
                            {{ Form::submit('内容を確認し投稿する', ["class"=>"recipe-submit__button"]) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
