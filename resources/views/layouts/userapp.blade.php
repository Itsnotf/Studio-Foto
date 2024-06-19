<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>


    @vite([])
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @include('includes.navuser')
            <div class="main-content">
                <section class="section">
                    <div class="section-body pt-20">
                        @yield('content')
                    </div>
                </section>
            </div>

        </div>
    </div>
</body>

</html>
