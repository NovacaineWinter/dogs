		
<template>

    <div style="margin-top:-69px" id="how-it-works-view">
        
        <section class="hero is-large herobanner" id="hiThereBanner">


            <div class="hero-body">
                <div class="container">             

                    <div class="tile is-ancestor">


                        <div class="tile is-parent is-6">
                            <div class="tile is-child has-text-centered">
                                <h2>Hi There !</h2>                            
                            </div>
                        </div>   
                        <div class="tile is-parent is-6"></div>                   

                        
                    </div>                              
                    
                </div>
            </div>          
        </section>

        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title has-text-centered">We would love to hear from you !</h1>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                 <contact-form></contact-form>
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

<script> 

    export default {
        
        mounted() {
            setTimeout( () => { window.scrollTo(0, 0);}, 100);
        },
    };

</script>


<style lang="scss">
    @import '~sass/variables';


    #hiThereBanner{
        background-size:cover;
        background-position:center;
        background-image:url('/img/hiThere.jpeg');
        h2{
            font-size:3.5vw;
            text-align:right;
            color:$text-dark;
            line-height:1;                
            text-transform:uppercase;       
        }
    }  
    
</style>

		