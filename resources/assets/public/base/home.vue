		
<template>
	<div style="margin-top:-69px" id="homeview">
		<a href="#firstSection" v-smooth-scroll="{ duration: 1000, offset: -85 }">		
			<span class="icon" id="downarrow">
				<i class="fas fa-arrow-circle-down has-text-centered"></i>
			</span>	
		</a>
		<section class="hero is-fullheight is-info" id="homebanner">


			<div class="hero-body">
				<div class="container">				

					<div class="tile is-ancestor">

						<div class="tile is-parent">
							<div class="tile is-child has-text-centered misty">
								<h1>App Name</h1>							
							</div>
						</div>


						<div class="tile is-4 is-vertical is-parent">

							<router-link tag="div" class="tile is-child box is-info button" to="/"><p>Link 1</p></router-link>					

							<router-link tag="div" class="tile is-child box button" to="/"><p>Link 2</p></router-link>

						</div>
						
					</div>								
					
				</div>
			</div>			
		</section>

	</div>

</template>



<script>
    export default {
        mounted() {
           setTimeout(() => {
		        window.scrollTo(0, 0);
		    }, 100);
        },
        /*
        methods:{
            beenClicked(){
                console.log('click');
            },
        },

        data: function() {
		    return{
		        url:'http://nbc.wip/img/partners/logos/bmf.jpg',
		        
		      }
	    },*/

    };
</script>



<style lang="scss">

	@import '~sass/variables';

	
	#downarrow{
		position: absolute;
		top: 75vh;
		left: 48vw;
		font-size: 10vw;
		color: $text-light;
	}

	.full-height{
		height:100%;
	}
	

	.trustlogos{
		max-height:90px;
	}
	
	#homeview .tile .button{
		margin-top:20px;
	}

	#homebanner{
		background-size:cover;
		background-position:center;
		text-transform:uppercase;

		.misty{
			background-color:rgba(255,255,255,0.2);
			border-radius:$button-border-radius;
			padding: 1.2vw 0px;
		}
		h1{
			font-size:3.5vw;
			color:$text-light;
			text-shadow: 3px 3px $text-dark;
			border-top:3px solid $text-dark;
			border-bottom:3px solid $text-dark;
			line-height:1;
			
		}
		p{
			padding:1.2vw;
			font-weight:600;
		}
		

	}
</style>

		