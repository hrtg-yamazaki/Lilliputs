@extends('single_layout')


@section('content')

    <div class="search-wrapper-single">

        <div class="search-contents">
            <div class="search-contents__box">
                <h2 class="search-contents__box__head">
                    検索
                </h2>
                <div class="search-contents__box__content">
                    <p class="search-message">
                        検索方法を選択してください
                    </p>
                    <ul class="search-ways">
                        <li class="search-way">
                            <a href={{ route("recipes.search.title") }} class="search-way__link">
                                タイトルで検索
                            </a>
                        </li>
                        <li class="search-way">
                            <a href={{ route("recipes.search.category") }} class="search-way__link">
                                メイン食材・調理方法で検索
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection
