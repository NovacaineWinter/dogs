		
<template>

	<nav class="navbar is-fixed-top">
	    
		<div class="container">
		    <div class="navbar-item">
		    	<h1 class="title">
		    		Toys And Treats		    		
		    	</h1>
		    </div>

		    <div class="navbar-burger burger">

		    	<router-link 
		    		v-for="(item, index) in items" 
		    		:key="index" 
		    		:to="item.uri" 
		    		tag="span"
		    		exact>
		    			{{ item.text }}
		    	</router-link>	        
		       
		    </div>

		    <div class="navbar-end">
		        <div class="navbar-start">

		        	<router-link  
		        		v-for="(item, index) in items"
		        		:class="item.bold ? 'navbar-item navborder' : 'navbar-item'" 	        		 
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
		height:69px;
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
		}

	}

	
	//override some quirk of Bulma that messes with the z-index
	.navbar.is-fixed-top{
		z-index:2;
	}
</style>

		