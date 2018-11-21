		
<template>
	<div id="homeview">
		
		<section class="hero is-medium herobanner" id="homebanner">


			<div class="hero-body">

				<div class="container herocontainer">				

					<div class="columns is-desktop main-slogan">

						<div class="column is-three-quarters-desktop">
							<div class="has-text-centered misty">
								<h1 class="maintitle landingtext">Every dog deserves <br>toys and treats</h1>
								<p class="mainsubtitle">A suprise gift box subscription for your dog</p>	
								<div class="columns is-mobile">
									<div class="column is-6"><div class="button widebutton landingtext clearbutton" @click="scrollintoview">Find Out More</div></div>
									<div class="column is-6">
										<router-link to="sign-up" tag="div" class="button landingtext is-info widebutton">Subscribe</router-link>
									</div>
								</div>						
							</div>
						</div>

						<div class="column is-one-quarter-desktop">						
							&nbsp;
						</div>
						
					</div>								
					
				</div>
			</div>

		</section>

		<section class="hero is-primary">
			<div class="hero-body">
				<h1 class="title has-text-centered quotetext">
					“Money can buy you a fine dog, but only love can make him wag his tail.”  -Kinky Friedman
				</h1>
			</div>
		</section>

		<section class="section slimsection" id="firstrowcolumns">
			<div class="container">				
				<div class="columns is-desktop">
					<div class="column"><img src="/img/dog3.jpeg"></div>
					<div class="column rightcol">
						<div class="textbox">
							<div class="textwrapper">
								<h1 class="subtitle"><span>What is a Toys and Treats Box?</span></h1>
								<p class="textblock">Simply pure doggie happiness. It is a surprise gift box subscription to show your dog how much you love them. Our team of expert pooches choose from an amazing range of toys,treats and other goodies to create a surprise that your dog is sure to look forward to. Boxes are dispatched every 4 weeks. Non-stop joy for your dog. </p>
							</div>

						</div>

					</div>
				</div>
			</div>
		</section>

		<section class="section slimsection">
			<div class="container">				
				<div class="columns is-desktop">
					<div class="column leftcol lastcol">
						<div class="textbox">
							<div class="textwrapper">
								<h1 class="subtitle"><span>Why should I get a Toys and Treats Box?</span></h1>
								<p class="textblock">We belive every dog should be made to feel special. Our dogs do so much for us, the unconditional love, the playful games, or trying to cheer you up when you feel down. Dogs give us so much of their love, wouldn't it be nice to return just a little of that love? Can you imagine how happy they would be to get an exciting gift box every 4 weeks? A Toys and Treats box is the simplest way of returning a little bit of that love they show you.</p>								
							</div>
						</div>
					</div>
					<div class="column"><img src="/img/dog2.jpeg"></div>
				</div>
			</div>
		</section>

		<section class="section slimsection">
			<div class="container is-desktop">				
				<div class="columns secondcolumns">
					<div class="column is-6 image-to-hide"><img src="/img/dog4.jpeg"></div>
					<div class="column is-6 rightcol lastcol">
						<div class="textbox">
							<div class="textwrapper">
								<h1 class="subtitle"><span>So how much does it cost?</span></h1>
								<span class="boldspan">A box costs &pound;14.97 and they are delivered every 4 weeks</span><br>
								( You can stop whenever you like! )								
								<br>
								<router-link to="/sign-up" tag="div" class="button is-primary is-outlined is-large">Subscribe Now</router-link>													
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	<section class="sectionbreak">&nbsp;</section>

        <section id="how-it-works-view" class="hero is-large herobanner howItWorksBanner">


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

 <!--        <section class="hero is-primary">
     <div class="hero-body">
         <div class="container">
             <h1 class="title has-text-centered">How you can make your dog happy month after month.</h1>
         </div>
     </div>
 </section> -->

        <section class="section howitworkstextsection">
            <div class="container">
                <div class="columns">

                    <div class="column">                       
                        <div class="card fullheight">                            
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                    1) Sign Up For An Account                                    
                                </h1> 
                                <p>
                                    Choose your plan, tell us about your dog and let us know where you want it delivered. 
                                </p><br>
                                                           
                            </div>                           
                        </div>
                    </div>


                    <div class="column">
                        <div class="card fullheight">             
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                    2) We hand pick a box of goodies for you dog                                  
                                </h1> 
                                <p>
                                    Our team will choose which toys and treats to send to your dog based on the size of your dog.
                                </p>                         
                            </div>                           
                        </div>                        
                    </div>


                    <div class="column">
                        <div class="card fullheight">
                            
                            <div class="card-content has-text-centered">
                                <h1 class="subtitle">
                                   3) Recieve your box of doggie happiness                               
                                </h1> 
                                <p>
                                    The big day! your dog receives their box in the post. Make sure to take photos and tag us in them!  
                                </p>                         
                            </div>                           
                        </div>
                    </div>


                </div>

            	<div class="button is-large is-primary is-centered-button">Subscribe Now</div> 					

            </div>
        </section>


<!-- 
        

	<section class="sectionbreak">&nbsp;</section>
	<section class="section unpaddedsection">
		<div class="container">
			<div class="columns borderedcontainer">
				<div class="column">&nbsp;</div>
				<div class="column is-8">
					<h1 class="subtitle"><span>How we started...</span></h1>
					<p>
						I’ve been around dogs my whole life, right from when I was a child growing up to the present day. It’s only when you spend time away from your dog that you realise how important they are to you. The company, the unconditional love and the games, having a dog is great.
						<br><br>

						If my dogs are anything like yours, they love their toys and will do anything for a tasty treat. Given how much my dogs do for me, I always try my best to get down the pet store frequently to get them a new toy and a refill on their treats. They are always super excited to get a new toy, so much so that when I gave Monte a new ball he took it round with him for the next three days! He slept next to it, spent most of the day playing with it and he only put it down to go for walkies. It meant so much to him to get a new toy.<br><br>

						As much as I try my best to give them new toys often, some times life is just a bit too busy, and despite my best efforts, sometimes the dogs go for a while without a new toy. It also doesnt help that my local pet store doensn’t have the greatest selection.<br><br>

						This is why I decided to start Toys and Treats, I know most dogs would love to get new toys every month and what dog would say no to tasty treats? Its a super convenient way to show your dog how much you love them. <br><br>

						We source Toys and Treats from all over, we have access to a massive selection of options so your dog will never get bored. Can you imagine how happy they would be?<br><br>

						Hope to be sending your dog a Toys and Treats box soon<br><br>
						Matt
						<br><br><br>
					</p>
					<img src="/img/portrait.jpeg">
				</div>			
				<div class="column">&nbsp;</div>
			</div>
		</div>
	</section>
 -->



	<section class="sectionbreak">&nbsp;</section>


		<section class="section producttesters">
			<div class="container">
				<h1 class="title has-text-centered">Meet our product testing team...</h1>
				<div class="columns">					
					<div class="columns parentcols column is-mobile">

						<div class="column">
							<div class="card">
							    <div class="card-image">
							        <figure class="image is-4by3">
							            <img src="/img/monte.jpeg" alt="Placeholder image">
							        </figure>
							    </div>
							    <div class="card-content">
							        <div class="media">
							            <div class="media-content">
							                <p class="title is-4">Monte</p>
							                <p class="subtitle is-6">Cairn Terrier</p>
							            </div>
							        </div>

							        <div class="content">
							            Monte is our resident little devil. Loves playing catch. Gets away with murder with those puppydog eyes. 
							        </div>
							    </div>
							</div>
						</div>

						<div class="column">
							<div class="card">
							    <div class="card-image">
							        <figure class="image is-4by3">
							            <img src="/img/benson.jpeg" alt="Placeholder image">
							        </figure>
							    </div>
							    <div class="card-content">
							        <div class="media">
							            <div class="media-content">
							                <p class="title is-4">Benson</p>
							                <p class="subtitle is-6">Springer Spaniel</p>
							            </div>
							        </div>

							        <div class="content">
							            Benson brings with him 14 years of chew toy experience, getting on in years, he knows what a good toy is. 
							        </div>
							    </div>
							</div>
						</div>
					</div>
					<div class="columns column parentcols is-mobile">

						<div class="column">
							<div class="card">
							    <div class="card-image">
							        <figure class="image is-4by3">
							            <img src="/img/harley.jpeg" alt="Placeholder image">
							        </figure>
							    </div>
							    <div class="card-content">
							        <div class="media">
							            <div class="media-content">
							                <p class="title is-4">Harley</p>
							                <p class="subtitle is-6">Rhodesian Ridgeback</p>
							            </div>
							        </div>

							        <div class="content">
							            Harley is our gentle giant with a very loud bark. He can sniff out the best treats in the offering.
							        </div>
							    </div>
							</div>
						</div>



						<div class="column">
							<div class="card">
							    <div class="card-image">
							        <figure class="image is-4by3">
							            <img src="/img/jimmy.png" alt="Placeholder image">
							        </figure>
							    </div>
							    <div class="card-content">
							        <div class="media">
							            <div class="media-content">
							                <p class="title is-4">Jimmy</p>
							                <p class="subtitle is-6">Daschund / Poodle cross</p>
							            </div>
							        </div>

							        <div class="content">
							        	Fully of energy, Jimmy is an endearing gentleman. He'll happily chew for hours at a time. 
							        </div>
							    </div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</section>



		<section class="hero is-medium herobanner" id="ctabanner">


			<div class="hero-body large-view">
				<div class="container has-text-centered">
					<div class="columns">
						<div class="column is-7"></div>
						<div class="column is-5 misty">
							<h1 class="title">Does your dog deserve a Toys and Treats box?</h1>									
							<div class="columns">
								<div class="column">									
									<router-link tag="div" to="/oh-ok"  class="button is-large clearbutton ctabutton">No, they don't! &#9785;</router-link>		
								</div>
								<div class="column">									
									<router-link tag="div" to="/sign-up" class="button is-large is-primary ctabutton">Yes, of course! <span class="emojispan">&#9786;</span></router-link>
								</div>
							</div>						
					
						</div>
					</div>
				</div>
			</div>	

			<div class="hero-body small-view">
				<div class="container has-text-centered">
					<h1 class="title misty">Does your dog deserve a Toys and Treats box?</h1>									
					<div class="columns is-mobile ctabuttonholder">
						<div class="column is-7"></div>
						<div class="column is-5">
							<div class="columns">
								<div class="column">									
									<router-link tag="div" to="/sign-up" class="button is-large is-primary ctabutton">Yes, of course! <span class="emojispan">&#9786;</span></router-link>
								</div>
								<div class="column">									
									<router-link tag="div" to="/oh-ok" class="button is-large clearbutton ctabutton">No, they don't! &#9785;</router-link>		
								</div>
							</div>						
					
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
        
        methods:{
            scrollintoview(){
                window.scrollTo(0, 0);
                var elemn = document.getElementById("firstrowcolumns");
                elemn.scrollIntoView({ behavior: 'smooth', block: "start" });
            },
        },
/*
        data: function() {
		    return{
		        url:'http://nbc.wip/img/partners/logos/bmf.jpg',
		        
		      }
	    },*/

    };
</script>



<style lang="scss">

	@import '~sass/variables';

	.small-view{
		display:none;
	}

	#firstrowcolumns{
		margin-bottom:6.5px;
	}

	.boldspan{
		font-size:22px;
		font-weight:900;
	}
	
	.slimsection{
		padding:0px;		
		.column{
			padding:0px;
		}
		.rightcol{
			border-right:1px solid $text-dark;
			box-sizing:border-box;
		}
		.leftcol{
			border-left:1px solid $text-dark;
			box-sizing:border-box;
		}
		.lastcol{
			margin-bottom:6.5px;			
		}
		.columns{
			margin-top:0px;
		}
		.secondcolumns{
			margin-top: 6.5px;
			margin-bottom: -6.5px;
		}
	}
	
	
	.unpaddedsection{
		padding-top:12px;
		padding-bottom:12px;
	}

	.textcontaner{
		width:50vw;
		margin:auto;
	}
	.borderedcontainer{
		border-right:1px solid $text-dark;
		border-left:1px solid $text-dark;
	}
	.sectionbreak{
		background-color:$brand-primary;
		min-height:70px;
	}

	.producttesters{
		.card{
			height:100%;
		}
		.parentcols{
			height:100%;
		}
	}

	.textbox{
		padding:40px;
		height:100%;
		text-align:center;
		h1{
			text-align:center;
			span{
				border-bottom:1px solid $text-dark;
			}
		}
		display: flex;
  		align-items: center;
  		justify-content: center;

  		.button{
  			margin-top:30px;
  		}
	}


	.bulletpointsok{
		list-style: disclosure-closed;
		margin-top:10px;
	}
	#homeview{
		#ctabanner{			
			.hero-body{
				padding: 11vw 0px;
			}
		}
		.widebutton{
			width: 100%;
			padding: 1.2vw;
			font-size: 1.6vw;
			font-weight: 300;
		}

		.textblock{
			font-size:1.2vw;
		}
	}
	.clearbutton{
		background:rgba(255,255,255,0.3);
		border:1px solid $text-dark;
		color:$text-dark;
	}
	.clearbutton:hover{
		background:rgba(255,255,255,0.9);			
	}

	.herobanner{
		background-size:cover;
		background-position:center;
		text-transform:uppercase;

		h1{
			font-size:3.5vw;
			color:$text-light;
			text-shadow: 0px 0px 8px $text-black;
			line-height:1;			
		}
		p{
			padding:1.2vw;
			font-weight:500;
			font-size:1.8vw;
			color:$text-light;
			text-shadow: 0px 0px 6px $text-black;
		}		
		
		.misty{
			background-color:rgba(255,255,255,0.2);
			border-radius:$button-border-radius;
			padding: 1.2vw 0px;
		}
	}

	#ctabanner{
		background-image:url('/img/ctabanner.jpeg');
		h1{
			font-size:2vw;
			font-weight:normal;
		}
		.colourmisty{
			background-color:rgba(0,209,178,0.4);
			/* border-radius:$button-border-radius; */
			padding: 2vw 0px;			
			color:$text-dark;
			text-shadow:none;
			
		}

		.ctabutton{
			padding:0.5vw;
			margin-top:2vw;
			width:100%;
			/*color:$text-light;*/
			font-size:1.5vw;
		}
		.emojispan{
			font-size: 1.8vw;
			padding-bottom: 0.2vw;
		}

	}

	#homebanner{
		background-image:url('/img/dogbanner2.jpeg');
		background-position:right;
	}


	#homeview{
		h1{
			font-size:2vw;		
		}

		h1.maintitle{
			font-size:3.5vw;
		}
		.subtitle{
			span{
				font-weight:bold;
			}
		}

		.quotetext{
			font-weight:300;
			font-size:27px;
		}
		.main-slogan{
			padding-top:6rem;
		}
		.howitworkstextsection{
			h1.subtitle{
				font-size:1.2vw;
			}
		}
		.is-centered-button{
			display: block;
			margin: auto;
			width: auto;
			max-width: 200px;
			font-size: 1.3vw;
			text-align: center;
		}
	}


 	#how-it-works-view{
        
        .fullheight{
            height:100%;
        }        

    }

    .howItWorksBanner{
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
      



	@media only screen and (max-width: $tabletbreak) {
	
		#homeview{
			h1{
				font-size:3vw;
			}
		}

	}

	@media only screen and (max-width: 768px) {
		//point at which columns stack vertically by default
		.image-to-hide{
			display:none;
		}

		.small-view{
			display:initial;
		}

		.large-view{
			display:none;
		}

		.title.misty{
			position:relative;
			top:-9vw;
		}
		#ctabanner{			
			.ctabuttonholder{
				position: relative;
				top: -4vw;
				.ctabutton{
					margin-top:5px;
					font-size:3vw;
				}
			}
		}

	}
	@media only screen and (max-width: 857px) {
		#homeview{
			h1.maintitle.landingtext{
				font-size:30px;
			}
			.landingtext{
				font-size:30px;
			}		
			p.mainsubtitle{
				font-size:20px;
			}				
		}
	}
	@media only screen and (max-width: 558px) {
		#homeview{
			.widebutton{
				font-size:5vw;
			}
		}
	}
	

	@media only screen and (max-width: 1068px) {
		p.mainsubtitle{
			font-size:2.7vw;
		}				
	}



	@media only screen and (max-width: 756px) {
		#homeview{
			#homebanner{
				min-height:70vh;
				background-position: 90% 0%;
			}

			.herocontainer{
				display: flex;
				height: 100%;
				align-items: center;
				justify-content: center;
			}
		}
	}

	@media only screen and (max-width: $phonebreak) {
		#homeview{
			h1{
				font-size:4vw;	
			}
		}
	}
</style>

		