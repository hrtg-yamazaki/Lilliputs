@extends('single_layout')


@section('content')

    <div class="form-section">
        <div class="recipe-form">
            <div class="recipe-form__box">
                <h2 class="recipe-form__box__head">
                    新規投稿
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
                            <h3 class="clearfix">
                                <p class="temp-left">
                                    <label>食材</label>
                                </p>
                                <p class="temp-right">
                                    <label>数量</label>
                                </p>
                            </h3>
                            @for($i = 1; $i <= 5; $i ++)
                                <div class="clearfix">
                                    <p class="temp-left">
                                        {{ Form::text("ingredients[".$i."][name]", null) }}
                                    </p>
                                    <p class="temp-right">
                                        {{ Form::text("ingredients[".$i."][amount]", null) }}
                                    </p>
                                </div>
                            @endfor
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
