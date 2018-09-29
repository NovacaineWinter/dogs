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
        <link href="{{{url('/css/app.css')}}}" rel="stylesheet" type="text/css">

     
    </head>
    <body>

        <div id="app">
            
          <!--   <nav class="navbar is-fixed-top">
              
              <div class="container">
                  <div class="navbar-start">
                      <div class="navbar-item">
                          <router-link to="/" tag="h1" class="title alwayshow">
                              Toys And Treats                 
                          </router-link>
                      </div>              
                  </div>
              </div>
          </nav> -->
            
            @yield('content')
        </div>

    </body>

</html>



       




        <main class="py-4">

        

        </main>
    </div>
</body>
</html>
