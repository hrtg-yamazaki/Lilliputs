
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
                    {{ Form::open(["method"=>"patch", "route"=>["recipes.update", $recipe], "class"=>"recipe-fields"]) }}
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
                        <div class="recipe-field extra-padding">
                            <p class="recipe-field__label">
                                {{ Form::label("description", "レシピの簡単な紹介文", ["class"=>"recipe-field__label__text"]) }}
                            </p>
                            <p class="recipe-field__input">
                                {{ Form::textarea("description", $recipe->description, ["class"=>"recipe-field__input__textarea"]) }}
                            </p>
                        </div>

                        <p class="half-border">&nbsp;</p>

                        <p>
                            {{ Form::select("maingred_id", $maingreds, $recipe->maingred_id ) }}
                        </p>
                        <p>
                            {{ Form::select("method_id", $methods, $recipe->method_id ) }}
                        </p>

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

                            @foreach($ingredientFields as $i => $field)
                                <div class="ingredient-field clearfix">
                                    @isset($field->id)
                                        {{ Form::hidden("ingredients[".$i."][id]", $field->id) }}
                                    @endisset
                                    <p class="ingredient-field__name">
                                        @isset($field->name)
                                            {{ Form::text("ingredients[".$i."][name]", $field->name, ["class"=>"ingredient-field__name__input"]) }}
                                        @else
                                            {{ Form::text("ingredients[".$i."][name]", null, ["class"=>"ingredient-field__name__input"]) }}
                                        @endisset
                                    </p>
                                    <p class="ingredient-field__amount">
                                        @isset($field->amount)
                                            {{ Form::text("ingredients[".$i."][amount]", $field->amount, ["class"=>"ingredient-field__amount__input"]) }}
                                        @else
                                            {{ Form::text("ingredients[".$i."][amount]", null, ["class"=>"ingredient-field__amount__input"]) }}
                                        @endisset
                                    </p>
                                </div>
                            @endforeach
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
