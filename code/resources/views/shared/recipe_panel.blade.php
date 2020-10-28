
<li class="recipe-panel">

    <a href={{ route('recipes.show', ['recipe' => $recipe]) }} class="recipe-panel__inner">
        <div class="panel-image">
            <p class="no-image">no image</p>
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
