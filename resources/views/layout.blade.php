<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{isVietnamese()?setting('site.title_vi'):setting('site.title')}} | @yield('title', '')</title>
        <meta name="description" content="@yield('description', '')">
        <meta name="keywords" content="@yield('keywords', '')">

        <link href="{{ !empty(setting('site.favicon'))?productImage(setting('site.favicon')):'/img/favicon.ico' }}" rel="SHORTCUT ICON" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">

        @yield('extra-css')

        <!-- Scripts -->
        <script>
            const LANG = '{{app()->getLocale()}}';
            const ROUTES = {
                'cart' : {
                    'add_to_cart': '{{route('cart.store')}}'
                }
            };
        </script>
    </head>


<body class="@yield('body-class', '')">
    @include('partials.nav')
    <div id="app">
        <div class="page-content">
            @yield('content')
        </div>

        @include('partials.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <div id="fb-root"></div>

    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=302064867211847&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    @yield('extra-js')
</body>
</html>
