
<li class="recipe-panel">

    <a href={{ route('recipes.show', ['recipe' => $recipe]) }} class="recipe-panel__inner">
        <div class="panel-image">
            @if(isset($recipe->image))
                @if(App::environment("local"))
                    <img src={{ asset("uploads/".$recipe->image) }} width="200px" height="200px">
                @else
                    <img src={{ $recipe->image }} width="200px" height="200px">
                @endif
            @else
                <p class="no-image">
                    No image
                </p>
            @endif
        </div>
        <div class="panel-info">
            <p class="panel-info__title">
                {{ $recipe->title }}
            </p>
            <div class="panel-info__property">
                {{ $recipe->maingred->name }} × {{ $recipe->method->name }}
            </div>
        </div>
    </a>

</li>
