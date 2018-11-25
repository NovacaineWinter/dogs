<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="siteurl" content="{{{env('SECURE_URL')}}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Toys and Treats | Log In</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" type="text/css">
     
    </head>
    <body>

        <div id="app">            
            @yield('content')
        </div>

    </body>
</html>
