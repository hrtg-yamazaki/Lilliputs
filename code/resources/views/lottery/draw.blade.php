@extends('single_layout')


@section('content')

    <div class="search-contents">
        <div class="search-contents__box">
            <h2 class="search-contents__box__head">
                くじ引き
            </h2>
            <div class="search-contents__box__content">
                <p class="search-message">
                    Coming soon...
                </p>
                <p class="search-message">
                    ( こちらの機能は近日公開予定です )
                </p>
                <p class="search-message">
                    <a href={{ route("root") }}>戻る</a>
                </p>
            </div>
        </div>
    </div>

@endsection