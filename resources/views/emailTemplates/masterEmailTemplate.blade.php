<!DOCTYPE html>
<html>
	<head>

		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
		<style>
			.container{
				max-width:1200px;
				margin:auto;
			}
			body{
				font-family: 'Raleway', sans-serif;
				color:#636b6f;
			}
			/* .banner{
				background-image:url("https://toysandtreats.co.uk/img/dogbanner2.jpeg");
				width:100vw;
				height:40vh;
				background-position: center;
				background-size: cover;				
			}
			.misty{
				background-color:rgba(255,255,255,0.2);
				border-radius:10px;
				padding: 1.2vw 0px;
			} */
			h1{
				font-size:50px;
				color:#00d1b2;
				text-align:center;
				font-weight:700;
			}
			h2{
				font-size:20px;
				font-weight:700;
				text-align:center;
			}
			p{
				font-size:1.8vw;
				font-weight: 300;
			}
		</style>

	</head>
	<body>
		<div class="container">
			<h1 class="misty">Toys and Treats</h1>
			<h2>Every dog deserves Toys and Treats</h2>			
			<p>
				@yield('subject')
				@yield('content')			
			</p>
		</div>

	</body>
</html>




