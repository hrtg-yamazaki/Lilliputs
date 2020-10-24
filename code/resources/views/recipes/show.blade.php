@extends('layout')


@section('content')

    <div class="show-sections">

        <div class="show-section">
            <div class="show-section__box">
                <div class="show-head clearfix">
                    <div class="show-head__left">
                        <div class="show-no-image">
                            No image
                        </div>
                    </div>
                    <div class="show-head__right">
                        <h2 class="show-title">
                            {{ $recipe->title }}
                        </h2>
                        <p class="show-category">
                            Maingred × Method
                        </p>
                        <p class="half-border">&nbsp;</p>
                        <p class="show-description">
                            &nbsp;&nbsp;{{ $recipe->description }}
                        </p>
                        <p class="half-border">&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
