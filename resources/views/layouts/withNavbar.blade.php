<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="siteurl" content="{{{env('SECURE_URL')}}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Toys and Treats | Gift Voucher</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
        <style type="text/css">
            .navbar{
                font-family:'Raleway','sans-serif';
                background-color:#fafafa;
                color:#636b6f;      
                height:69px;
                border-bottom:1px solid #0077cf;  
                text-transform: uppercase;
                letter-spacing: .1rem;
            }
            .navbar.is-fixed-top{
                z-index:2;
            }
            .content{
                margin-top:69px;
            }

            #homebanner{
                background-image:url('/img/dogbanner2.jpeg');
                background-position:right;
            }
            .herobanner{
                background-size:cover;
                background-position:center;
                text-transform:uppercase;
            }
            .herobanner h1{
                font-size:3.5vw;
                color:$text-light;
                text-shadow: 0px 0px 8px $text-black;
                line-height:1;          
            }
            .herobanner p{
                font-weight:500;
                font-size:1.2vw;
                color:$text-light;
                text-shadow: 0px 0px 6px $text-black;
            }       
                
            .hero.is-medium .hero-body{
                padding-bottom:3rem;
            }

            .misty{
                background-color:rgba(255,255,255,0.2);
                border-radius:$button-border-radius;
                padding: 1.2vw 0px;
            }

        </style>
    </head>
    <body>

        <div id="app">

              <nav class="navbar is-fixed-top">                
                <div class="container">
                    <div class="navbar-start">
                        <div class="navbar-item">
                            <h1 class="title">Toys And Treats</h1>
                        </div>              
                    </div> 
                </div>

            </nav>
            <div class="content">
                @yield('content')                
            </div>
            
        </div>

    </body>  
</html>
