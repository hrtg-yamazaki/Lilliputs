
@extends('single_layout')


@section('content')

    <div class="form-section">
        <div class="recipe-form">
            <div class="recipe-form__box">
                <h2 class="recipe-form__box__head">
                    レシピ
                    <strong class="form-recipe-title">
                        {{ $recipe->title }}
                    </strong>
                    の編集
                </h2>
                <div class="recipe-form__box__content">
                    {{ Form::open(["method"=>"patch", "route"=>["recipes.update", $recipe], "files"=>"true", "class"=>"recipe-fields"]) }}
                        {{ csrf_field() }}
                        @if ($errors->any())
                            @include("shared.errors")
                        @endif
                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                {{ Form::label("title", "レシピのタイトル", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::text("title", $recipe->title, ["class"=>"recipe-field__input__textbox"]) }}
                            </p>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                <label class="recipe-field__label__text">
                                    料理の画像
                                </label>
                            </p>
                            <div class="recipe-field__input">
                                <p class="recipe-field__input__attention">
                                    変更を希望する場合のみアップロードしてください
                                </p>
                                {{ Form::file("image", ["class"=>"recipe-field__input__image"]) }}
                            </div>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field">
                            <p class="recipe-field__label">
                                <label class="recipe-field__label__text">メイン食材 と 調理法</label>
                            </p>
                            <div class="recipe_field__input clearfix">
                                <p class="half-field field-left">
                                    {{ Form::select("maingred_id", $maingreds, $recipe->maingred_id) }}
                                </p>
                                <p class="half-field field-right">
                                    {{ Form::select("method_id", $methods, $recipe->method_id) }}
                                </p>
                            </div>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-field extra-padding">
                            <p class="recipe-field__label">
                                {{ Form::label("description", "レシピの簡単な紹介文", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::textarea("description", $recipe->description, ["class"=>"recipe-field__input__textarea"]) }}
                            </p>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="ingredient-form js-edit-ingredients">

                            <edit-ingredients v-bind:ingredients="{{ json_encode($ingredients) }}">
                            </edit-ingredients>

                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="process-form">
                            <h3 class="process-form__head">
                                作り方
                            </h3>
                            <div class="process-form__content">
                                @foreach($processFields as $i => $processField)
                                    <div class="process-field clearfix">
                                        <h4 class="process-field__head">
                                            {{ $i + 1 }}.
                                        </h4>
                                        @isset($processField->id)
                                            {{ Form::hidden("processes[".$i."][id]", $processField->id) }}
                                        @endisset
                                        <p class="process-field__input">
                                            @isset($processField->content)
                                                {{ Form::textarea("processes[".$i."][content]", $processField->content, ["class"=>"process-field__input__textarea"]) }}
                                            @else
                                                {{ Form::textarea("processes[".$i."][content]", null, ["class"=>"process-field__input__textarea"]) }}
                                            @endisset
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <div class="recipe-submit">
                            {{ Form::submit('編集を完了する', ["class"=>"recipe-submit__button"]) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
