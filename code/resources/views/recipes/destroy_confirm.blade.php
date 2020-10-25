@extends('single_layout')


@section('content')

    <div class="confirm-section">
        <div class="confirm-form">
            <div class="confirm-form__box">
                <h2 class="confirm-form__box__head">
                    レシピの削除
                </h2>
                <div class="confirm-form__box__content">
                    <p class="confirm-message">
                        レシピ：
                        <strong class="confirm-message__title">
                            {{ $recipe->title }}
                        </strong>
                        を本当に削除してよろしいですか？
                    </p>

                    {{ Form::open(["method"=>"delete", "route"=>["recipes.destroy",$recipe], "class"=>"destroy-form"]) }}
                        {{ csrf_field() }}
                        {{ Form::submit("削除", ["class"=>"destroy-form__button"]) }}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection

