		
<template>
	<div>		

		<section class="hero is-fullheight herobanner" id="ohOkBanner">

			<div class="hero-body">
				<div class="container">				

				

							<div class="has-text-centered misty">
								<h1 class="maintitle">Ohhh, ok  &#9785;</h1>							
							</div>


								
					
				</div>
			</div>			
		</section>
	</div>	
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    	
        mounted() { 
            
            setTimeout( () => { window.scrollTo(0, 0);}, 10);
        },
/*
        methods:{
            myMethod(){
                console.log('my method triggered');
            },
        },

        computed:{
        	someNumber(){
        		return 2+3;
        	},        	
        },

        data: function() {
		    return{
		        someDataOnThis:'',		        
		      }
	    },

	    props: [
		    'propsPassed'
	    ], */

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	#ohOkBanner{
		background-image:url('/img/ohOk.jpeg');
		background-size:cover;
		background-position:center;
		.misty{
			background-color:rgba(255,255,255,0.2);
			border-radius:$button-border-radius;
			padding: 1.2vw 0px;
		}

		h1{
			font-size:3.5vw;
			color:$text-light;
			text-shadow: 0px 0px 8px $text-black;
			line-height:1;
			text-transform:none;
		}

	}
</style>

		