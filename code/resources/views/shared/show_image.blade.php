<div class="show-image">

    @if(isset($recipe->image))
        @if(App::environment("local"))
            <img src={{ asset("uploads/".$recipe->image) }} width="430px" height="430px">
        @else
            <img src={{ $recipe->image }} width="430px" height="430px">
        @endif
    @else
        <div class="show-no-image">
            No image
        </div>
    @endif

</div>