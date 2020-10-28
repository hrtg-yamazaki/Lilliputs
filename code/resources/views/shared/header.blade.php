
<header class="header">
    <div class="header__box clearfix">
        <div class="header__box__left">
            <a href="{{ route('root') }}" class="header-title">
                Lilliputs
            </a>
        </div>
        <div class="header__box__right">
            @auth
                <span class="header-user-name">
                    <strong>{{ Auth::user()->name }}</strong> さん
                </span>
                <a href={{ route("logout_confirm") }} class="header-link">
                    ログアウト
                </a>
                
            @else
                <a href="{{ route('login') }}" class="header-link">
                    ログイン
                </a>
            @endauth
        </div>
    </div>
</header>
