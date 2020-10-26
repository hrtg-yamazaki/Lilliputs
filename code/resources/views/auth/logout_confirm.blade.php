@extends('single_layout')


@section('content')

    <div class="confirm-section">
        <div class="confirm-form">
            <div class="confirm-form__box">
                <h2 class="confirm-form__box__head">
                    ログアウト
                </h2>
                <div class="confirm-form__box__content">

                    <p class="confirm-message">
                        ログアウトしてよろしいですか？
                    </p>

                    {{ Form::open(["method"=>"post", "route"=>"logout", "class"=>"logout-form"]) }}
                        {{ csrf_field() }}
                        {{ Form::submit("ログアウト", ["class"=>"logout-form__button"]) }}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection
