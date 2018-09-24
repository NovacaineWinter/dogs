<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="siteurl" content="{{{url('/')}}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Toys and Treats | Happiness for Dogs</title>

        <!-- Styles -->
        <link href="{{{url('/css/app.css')}}}" rel="stylesheet" type="text/css">

     
    </head>
    <body>

        <div id="app">
            
            <navbar-component></navbar-component>

            <router-view></router-view>

            <footer-component></footer-component>

        </div>

    </body>

    <!-- JS -->
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="{{{ url('js/app.js') }}}"></script>

</html>
