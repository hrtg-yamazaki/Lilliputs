
@extends('single_layout')


@section('content')

    <div class="auth-section">
        <div class="auth-form">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <h2 class="auth-form__box__head">
                    パスワード再設定
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

                    <div class="auth-field">
                        <label for="password" class="auth-field__label">パスワード</label>
                        <input id="password" type="password" class="auth-field__text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password-confirm" class="auth-field__label">パスワード ( 確認 ) </label>
                        <input id="password-confirm" type="password" class="auth-field__text @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="auth-submit">
                        <button type="submit" class="auth-submit__button">
                            再設定
                        </button>
                    </div>

                    @if (session('status'))
                        <div class="auth-status-message" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

            </form>
        </div>
    </div>

@endsection
