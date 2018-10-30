<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NFramework-Dashboard</title>
    <link rel="icon" type="image/png" href="/images/favicon.png" />

    <!--Core CSS -->
    <link rel="stylesheet" href="/creyo/css/bulma.css">
    <link rel="stylesheet" href="/creyo/css/core.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">

    <!-- plugins -->
    <link rel="stylesheet" href="/creyo/js/slick/slick.css">
    <link rel="stylesheet" href="/creyo/js/slick/slick-theme.css">
    <link rel="stylesheet" href="/creyo/js/webuipopover/jquery.webui-popover.min.css">
    <link rel="stylesheet" href="/creyo/js/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="/creyo/js/zoom/zoom.css">
    <link rel="stylesheet" href="/creyo/js/jpcard/card.css">
    <link rel="stylesheet" href="/creyo/css/chosen/chosen.css">

    <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
</head>
<body>
<div id="app">
    @yield('content')
</div>

<!-- Helios js -->
<script src="/creyo/js/app.js"></script></body>
<script src="/creyo/js/nephos.js"></script></body>

<!-- Concatenated plugins -->
<script src="{{ mix('/creyo/manifest.js') }}"></script>
<script src="{{ mix('/creyo/vendor.js') }}"></script>
<script src="{{ mix('/creyo/app.js') }}"></script>
</html>
