<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ env('APP_NAME', 'laravel')}}</title>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>
        <link rel='stylesheet' href='{{ asset("css/app.css") }}'>
        <script src='{{ asset("js/app.js") }}' defer></script>
    </head>
    <body>


        @include("shared.header")

        <div class="container">
            <div class="single-main">
                <div class="single-main__box">

                    @yield("content")

                </div>
            </div>
        </div>

        @include("shared.footer")

    </body>
</html>
