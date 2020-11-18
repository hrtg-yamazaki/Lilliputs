@extends('single_layout')


@section('content')

    <div class="auth-section">
        <div class="auth-form">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <h2 class="auth-form__box__head">
                    パスワード再登録
                </h2>

                <div class="auth-form__box__content">

                    <div class="auth-field">
                        <label for="email" class="auth-field__label">メールアドレス</label>
                        <input id="email" type="email" class="auth-field__text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="auth-submit">
                        <button type="submit" class="auth-submit__button">
                            メールを送信する
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

@endsection