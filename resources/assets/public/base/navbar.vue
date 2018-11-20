		
<template>

	<nav class="navbar is-fixed-top">
	    
		<div class="container">
			<div class="navbar-start">
			    <div class="navbar-item">
			    	<router-link to="/" tag="h1" class="title alwayshow">
			    		Toys And Treats		    		
			    	</router-link>
			    </div>				
			</div>

		  <!--   <div class="navbar-burger burger">
		  
		  	<router-link 
		  		v-for="(item, index) in items" 
		  		:key="index" 
		  		:to="item.uri" 
		  		tag="span"
		  		exact>
		  			{{ item.text }}
		  	</router-link>	        
		     
		  </div> -->
		  

		    <div class="navbar-end">
		        <div class="navbar-start">

		        	<router-link  
		        		v-for="(item, index) in items"
		        		:class="cssClass(item)"
		        			        		 
		        		:key="index" 
		        		v-bind:to="item.uri" 
		        		tag="span"
		        		exact>
		        			<span>{{ item.text }}</span>
		        	</router-link>	

		        	<a href="/login" class="navbar-item"><span>Login</span></a>

		        </div>
		    </div>  
		    
		</div>

	</nav>

   
</template>

<script>

    import navbarItems from '../setup/navbarItems';

    export default {

        methods:{
            sortItems(items){
                return items.sort(this.sortFunction);
            },

            cssClass(item){
            	let theCssClass="navbar-item"
            	if(item.bold){
            		theCssClass = theCssClass+' navborder'
            	}
            	if(item.hideSmall){
            		theCssClass = theCssClass+' hideOnSmallNavbar'
            	}
            	return theCssClass;
            },

            sortFunction(a,b){
            	if (a['position'] === b['position']) {
			        return 0;
			    }
			    else {
			        return (a['position'] < b['position']) ? -1 : 1;
			    }
            }
        },

        data: function() {
		    return{
		       items:this.sortItems(navbarItems),	        
		      }
	    },
    };
</script>



<style lang="scss">
	@import '~sass/variables';

	.navbar{
		font-family:'lato','sans-serif';
		background-color:$nav-color;
		color:$text-light;		
		height:$big-navbar-height;
		border-bottom:1px solid $brand-secondary;
		
		.navbar-item{
			color:$text-dark;	
			font-size:12px;		
			letter-spacing: .1rem;
			text-transform:uppercase;
			cursor:pointer;
			span{				
				padding: 10px 25px;
			}
		}
	
		.navbar-item.is-active{
			color:$link-active-light;
			border-color:$link-active-light;
		}

		 .navbar-item:hover{
		 	span{
				color:$text-light;
				background-color:$brand-secondary;					 		
		 	}
		} 
		.navborder span{
			border: 1px solid $text-dark;
			border-radius: 5px;
		}

	}

	
	//override some quirk of Bulma that messes with the z-index
	.navbar.is-fixed-top{
		z-index:2;
	}
	@media only screen and (max-width: $phonebreak) {
		.navbar{
			.navbar-item{
				span{
					padding:5px;
					font-size:3vw;
				}

			}			
		}
	}	

	@media only screen and (max-width: $tabletbreak) {
		.navbar,.navbar-start,.navbar-end{
			
				-webkit-box-pack: start;
				-ms-flex-pack: start;
				justify-content: flex-start;
				margin-right: auto;
				-webkit-box-align: stretch;
				-ms-flex-align: stretch;
				align-items: stretch;
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;				
			
		}	
		.navbar{
			height:$small-navbar-height;
			
			.container{
				display:flex;
				width:100vw;
			}
			.navbar-item{
				display:flex;
			}
		    .hideOnSmallNavbar{
		    	display:none;
		    }
		    .title{
		        font-size:3vw;
		    }
		    .router-link-exact-active{
		    	display:none;
		    }
			.router-link-exact-active.alwayshow{
				display:initial;
			}
		}

	}
</style>

		