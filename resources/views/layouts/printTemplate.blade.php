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


            body{
                min-height: 100vh;
                overflow-x:scroll; 
            }
            #app{
                width:21cm;
                margin:auto;
                text-transform:uppercase;
                font-family:'Raleway','sans-serif';
                background-color:#fafafa;
                color:#636b6f;   
            }
         

            #homebanner{
                background-image:url('/img/dogbanner2.jpeg');
                background-position:center;
                background-size: cover;
            }
          
            h1{
                font-size:0.6cm;               
            }
            p{
                font-weight:500;
                font-size:0.5cm;
            }      
            
            .container{
                padding: 50px;
                box-sizing: border-box;
            }

            span{
                font-weight: bold;
            }


            .bottombanner{
                background-color: #00d1b2;
            }

            .bottombanner h1{
                font-size: 0.7cm;
                font-weight: 300;
                text-align: center;
                padding: 20px 0px;
            }

            .misty{
                background-color: rgba(255,255,255,0.5);
                border-radius: 10px;
                padding: 20px 0px;
                width: 14cm;
                margin-left: -0.5cm;
                text-align: center;
            }

        </style>
    </head>
    <body>

        <div id="app">

           <!--  <nav class="navbar is-fixed-top">                
               <div class="container">
                   <div class="navbar-start">
                       <div class="navbar-item">
                           <h1 class="title">Toys And Treats</h1>
                       </div>              
                   </div> 
               </div>
           </nav>
            -->

            <div class="content">
                @yield('content')                
            </div>
            
        </div>

    </body>  
</html>
