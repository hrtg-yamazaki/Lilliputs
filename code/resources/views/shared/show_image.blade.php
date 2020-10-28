<div class="show-image">

    @if(isset($recipe->image))
        <img src={{ asset("uploads/".$recipe->image) }} width="430px" height="430px">
    @else
        <div class="show-no-image">
            No image
        </div>
    @endif

</div>