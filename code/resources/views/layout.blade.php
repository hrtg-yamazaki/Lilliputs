<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ env('APP_NAME', 'laravel')}}</title>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>
        @if(App::environment("production"))
            <link rel='stylesheet' href='{{ secure_asset("css/app.css") }}'>
            <script src='{{ secure_asset("js/app.js") }}' defer></script>
        @else
            <link rel='stylesheet' href='{{ asset("css/app.css") }}'>
            <script src='{{ asset("js/app.js") }}' defer></script>
        @endif
    </head>
    <body>


        @include("shared.header")
        @include("shared.navi_bar")

        <div class="container">

            @yield("top-wrapper")

            <div class="main-contents">
                <div class="main-contents__box">

                    @yield("content")

                </div>
            </div>

        </div>

        @include("shared.footer")

    </body>
</html>
