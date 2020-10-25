@extends('single_layout')


@section('content')

    <div class="form-section">
        <div class="recipe-form">
            <div class="recipe-form__box">
                <h2 class="recipe-form__box__head">
                    {{ $head }}
                </h2>
                <div class="recipe-form__box__content">
                    {{ Form::open(["route" => "recipes.store"]) }}
                        {{ csrf_field() }}
                        @if ($errors->any())
                            @include("shared.errors")
                        @endif
                        <div>
                            <p>{{ Form::label("title", "タイトル") }}</p>
                            <p>{{ Form::text("title", null) }}</p>
                        </div>
                        <div>
                            <p>{{ Form::label("description", "レシピの簡単な紹介文") }}</p>
                            <p>{{ Form::textarea("description", null) }}</p>
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
