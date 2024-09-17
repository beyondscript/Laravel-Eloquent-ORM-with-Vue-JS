<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta property="og:image" content="{{ asset('images/icons/facebookimage.png') }}">

        <link rel="icon" type="image/webp" href="{{asset('images/icons/favicon.webp')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>{{config('app.name')}}</title>

        @vite('resources/css/app.css')
    </head>
    <body id="body" class="main">
        @yield('content')

        @vite('resources/js/app.js')
    </body>
</html>