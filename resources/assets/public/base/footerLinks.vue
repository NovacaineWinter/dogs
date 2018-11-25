<template>
	<div id="footer">

		<section class="section">
			
			<div class="container">
				<h1 class="title has-text-centered">Follow Us</h1>
				<div class="columns socialicons">

					<a href="https://twitter.com/ToysTreatsBox" class="column has-text-centered">
						<font-awesome-icon :icon="['fab', 'twitter']" />
						<h6>Twitter</h6>
					</a>

					<a href="https://www.instagram.com/ToysAndTreatsBox/" tag="div" class="column has-text-centered">
						<font-awesome-icon :icon="['fab', 'instagram']" />
						<h6>Instagram</h6>
					</a>

					<a href="https://www.facebook.com/ToysAndTreatsBox/" tag="div" class="column has-text-centered">							
						<font-awesome-icon :icon="['fab', 'facebook-square']" />
						<h6>Facebook</h6>
					</a>
					
				</div>
			</div>
		</section>

		<section class="hero is-medium is-bold is-primary">
			<div class="hero-body">
				<div class="container">

					<div class="columns">
						<div class="column">
							<h2 class="subtitle">Toys and Treats</h2>
							<ul>
								<router-link tag="li" to="/" class="navbar-item" exact><span>Home</span></router-link>
					            <router-link tag="li" to="/how-it-works" class="navbar-item" exact><span>How It Works</span></router-link>
					            <router-link tag="li" to="/contact-us" class="navbar-item" exact><span>Contact Us</span></router-link> 
					            <router-link tag="li" to="/sign-up" class="navbar-item" exact><span>Subscribe</span></router-link> 
			            	</ul>
			            </div>
						<div class="column">
							<h2 class="subtitle">Boring Stuff</h2>
							<ul>
					            <router-link tag="li" to="/privacy-policy" class="navbar-item" exact><span>Privacy and Cookie Policy</span></router-link>
					            <router-link tag="li" to="/data-retention" class="navbar-item" exact><span>Data Retention Policy</span></router-link> 
					            <router-link tag="li" to="/terms-and-conditions" class="navbar-item" exact><span>Terms and Conditions</span></router-link> 
			            	</ul>
						</div>

						<div class="column">
							<!-- 
							<h2 class="subtitle">About</h2>
							<ul>
								<router-link tag="li" to="/about-us" class="navbar-item" exact><span>About Us</span></router-link>
				            	<router-link tag="li" to="/environment" class="navbar-item" exact><span>Our environmental impact</span></router-link>
		            		</ul>
							 -->
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<div class="navbar">
	        <div class="navbar-start container">
	            <router-link to="/" class="navbar-item" exact><span>&copy; Toys and Treats {{ (new Date()).getFullYear() }}</span></router-link>
	        </div>
		</div>
	</div>
</template>

<style lang="scss">
    @import '~sass/variables';
   
    #footer{
      .navbar-item{
      	cursor:pointer;
      }
      .navbar-item:hover{
      	color:$link-active-light;
      }



		
    .socialicons{
		.column:hover{
			background-color:$brand-primary;
			color:#fff;
			border-radius:20px;
		}

      	.column{      		
      		color:$brand-primary;
      	}
      	font-size:5.5vw;
      	h6{
      		font-size:3vw;
      	}
      }
    }  

</style>

