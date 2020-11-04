<div class="show-image">

    @if(isset($recipe->image))
        @if(App::environment("local"))
            <img src={{ asset("uploads/".$recipe->image) }}>
        @else
            <img src={{ url($recipe->image) }}>
        @endif
    @else
        <div class="show-no-image">
            No image
        </div>
    @endif

</div>