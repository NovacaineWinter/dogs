		
<template>

    <div style="margin-top:-69px" id="how-it-works-view">
        
        <section class="hero is-large herobanner" id="howItWorksBanner">


            <div class="hero-body">
                <div class="container">             

                     <div class="tile is-ancestor">


                        <div class="tile is-parent is-6"></div>                   
                        <div class="tile is-parent is-6">
                            <div class="tile is-child has-text-centered">
                                <h2>How It Works...</h2>                            
                            </div>
                        </div>   

                        
                    </div>                                            
                    
                </div>
            </div>          
        </section>

        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title has-text-centered">How you can make your dog happy month after month.</h1>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="columns">

                    <div class="column">                       
                        <div class="card fullheight">
                            <div class="card-content has-text-centered">
                                <h1 class="title">
                                    Step<br>1                                    
                                </h1>                                
                            </div>
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                    Sign Up For An Account                                    
                                </h1> 
                                <p>
                                    Its super quick and easy - choose your plan, tell us about your dog and let us know where you want it delivered. 
                                </p><br>
                                <div class="button is-large is-primary">Subscribe Now</div>                            
                            </div>                           
                        </div>
                    </div>


                    <div class="column">
                        <div class="card fullheight">
                            <div class="card-content has-text-centered">
                                <h1 class="title">
                                    Step<br>2                                   
                                </h1>                                
                            </div>
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                    We hand pick a box of goodies for you dog                                  
                                </h1> 
                                <p>
                                    Our team will choose which toys and treats to send to your dog based on the size of your dog and which plan you choose. We post boxes out once a month, you can see when your next delivery is due by logging in on our website. 
                                </p>                         
                            </div>                           
                        </div>                        
                    </div>


                    <div class="column">
                        <div class="card fullheight">
                            <div class="card-content has-text-centered">
                                <h1 class="title">
                                    Step<br>3
                                </h1>                                
                            </div>
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                    Recieve your box of doggie happiness                               
                                </h1> 
                                <p>
                                    The big day! your dog receives their box in the post. Make sure to take photos and videos and tag us in them!  
                                </p>                         
                            </div>                           
                        </div>
                    </div>


                </div>
            </div>
        </section>





<!-- 

                    <div class="column is-2">&nbsp;</div>
                    <div class="column">
                        

                        <div class="columns">
                            <div class="column bignumber">Step<br>1</div>
                            <div class="column">
                                <span>Sign Up For An Account</span>
                                <p>
                                    Its super quick and easy - choose your plan, tell us about your dog and let us know where you want it delivered. 
                                </p>
                                <div class="button is-large is-primary">Subscribe Now</div>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column bignumber">Step<br>2</div>
                            <div class="column">
                                <span>We hand pick a box of goodies for you dog</span>
                                <p>
                                    Our team will choose which toys and treats to send to your dog based on the size of your dog and which plan you choose. We post boxes out once a month, you can see when your next delivery is due by logging in on our website. 
                                </p>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column bignumber">Step<br>3</div>
                            <div class="column">
                                <span>Recieve your box of doggie happiness</span>
                                <p>
                                    The big day! your dog receives their box in the post. Make sure to take photos and videos and tag us in them! 
                                </p>
                            </div>
                        </div>


                    </div>
                    <div class="column is-2">&nbsp;</div>
                </div>
            </div>
        </section> -->
    </div>



</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    
        mounted() {                    
          setTimeout( () => { window.scrollTo(0, 0);}, 100);
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
   
    #how-it-works-view{
        .fullheight{
            height:100%;
        }        
    }

    #howItWorksBanner{
        background-size:cover;
        background-position:center;
        background-image:url('/img/howItWorks.jpeg');
        h2{
            font-size:3.5vw;
            text-align:right;
            color:$text-dark;
            line-height:1;                
            text-transform:uppercase;       
        }

    }  

</style>

		