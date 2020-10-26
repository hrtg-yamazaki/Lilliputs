
<div class="navi-bar">
    <div class="navi-bar__box">

        <ul class="navi-list">

            <li class="navi-list__content">
                <a href="#" class="navi-list__content__link">
                    検索
                </a>
            </li>{{--

        --}}<li class="navi-list__content content-center">
                <a href="#" class="navi-list__content__link">
                    ルーレット
                </a>
            </li>{{--

        --}}@auth{{--
            --}}<li class="navi-list__content">
                    <a href={{ route("recipes.create") }} class="navi-list__content__link">
                        レシピ投稿
                    </a>
                </li>
            @else{{--
            --}}<li class="navi-list__content">
                    <a href={{ route("register") }} class="navi-list__content__link">
                        ユーザー登録
                    </a>
                </li>
            @endauth

        </ul>

    </div>
</div>
