@extends('single_layout')


@section('content')

    <div class="auth-section">
        <div class="auth-form">
            <form method="POST" action="{{ route('login') }}" class="auth-form__box">
                @csrf

                <h2 class="auth-form__box__head">
                    ログイン
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
                        <input id="password" type="password" class="auth-field__text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div style="display: none;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div style="display: none;">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="auth-submit">
                        <button type="submit" class="auth-submit__button">
                            ログイン
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

@endsection
