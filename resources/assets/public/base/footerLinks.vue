<template>
	<div id="footer">
		<section class="hero is-medium is-bold is-branded">
			<div class="hero-body">
				<div class="container">

					<div class="columns">
						<div class="column">
							<h2 class="subtitle">App Name</h2>
							<ul>
								<router-link tag="li" to="/" class="navbar-item" exact><span>Home</span></router-link>
					            <router-link tag="li" to="/" class="navbar-item" exact><span>Other Link</span></router-link>
					            <router-link tag="li" to="/" class="navbar-item" exact><span>Yet Another link</span></router-link> 
			            	</ul>
			            </div>
						<div class="column">
							<h2 class="subtitle">Other Section</h2>
							<ul>
								<router-link tag="li" to="/" class="navbar-item" exact><span>Home</span></router-link>
 
			            	</ul>
						</div>
						<div class="column">
							<h2 class="subtitle">About</h2>
							<ul>
								<router-link tag="li" to="/" class="navbar-item" exact><span>Home</span></router-link>
					            <router-link tag="li" to="/" class="navbar-item" exact><span>Other Link</span></router-link>
					            <router-link tag="li" to="/" class="navbar-item" exact><span>Yet Another link</span></router-link>           

			            	</ul>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<div class="navbar">
	        <div class="navbar-start container">
	            <router-link to="/" class="navbar-item" exact><span>&copy; Appname {{ (new Date()).getFullYear() }}</span></router-link>
	        </div>
		</div>
	</div>
</template>