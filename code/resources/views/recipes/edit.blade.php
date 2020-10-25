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
                    {{ Form::open(["method"=>"patch", "route"=>["recipes.update", $recipe]]) }}
                        {{ csrf_field() }}
                        @if ($errors->any())
                            @include("shared.errors")
                        @endif
                        <div>
                            <p>{{ Form::label("title", "タイトル") }}</p>
                            <p>{{ Form::text("title", $recipe->title) }}</p>
                        </div>
                        <div>
                            <p>{{ Form::label("description", "レシピの簡単な紹介文") }}</p>
                            <p>{{ Form::textarea("description", $recipe->description) }}</p>
                        </div>
                        <div>
                            {{ Form::submit('投稿する') }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection