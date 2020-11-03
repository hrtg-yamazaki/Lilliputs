@extends('layout')


@section("top-wrapper")

    <div class="top-wrapper">
        <div class="top-wrapper__box">
            <h1 class="top-wrapper__box__text">
                Leave dishes to Luck.
            </h1>
        </div>
    </div>

@endsection


@section('content')

    <div class="index-sections">

        <div class="index-section">
            <div class="index-section__box">
                <h1 class="index-section__box__head">
                    最新の投稿
                </h1>
                <div class="index-section__box__content">
                    <ul class="recipe-list">
                        @if ($recipes)
                            @foreach($recipes as $recipe)

                                @include("shared.recipe_panel")

                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="index-section border-top">
            <div class="index-section__box">
                <h1 class="index-section__box__head right-head">
                    ご利用について
                </h1>
                <div class="index-section__box__content">
                    <div class="site-about-list">
                        <ul class="site-about-list__box">
                            <li class="site-about">
                                <h3 class="site-about__head">
                                    <span class="site-about__head__number">
                                        1.&nbsp;
                                    </span>
                                    レシピの閲覧と検索
                                </h3>
                                <p class="site-about__content">
                                    &nbsp;投稿されているレシピはどれでも自由に閲覧できます。名前やカテゴリによる検索も可能です。
                                </p>
                            </li>
                            <li class="site-about">
                                <h3 class="site-about__head">
                                    <span class="site-about__head__number">
                                        2.&nbsp;
                                    </span>
                                    「くじ引き」によるレシピ提案
                                </h3>
                                <p class="site-about__content">
                                    &nbsp;ランダムに提案される「メイン食材」と「調理方法」の組み合わせで、メニュー決めをサポートします。
                                </p>
                            </li>
                            <li class="site-about">
                                <h3 class="site-about__head">
                                    <span class="site-about__head__number">
                                        3.&nbsp;
                                    </span>
                                    レシピの投稿
                                </h3>
                                <p class="site-about__content">
                                    &nbsp;もちろん、ユーザー登録をすればレシピの投稿もできます。自分向けのメモとしても！
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
