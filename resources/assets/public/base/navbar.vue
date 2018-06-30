		
<template>

	<nav class="navbar is-fixed-top">
	    
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
		background-color:$brand-secondary;
		color:$text-light;		
		height:69px;
		
		.navbar-item{
			color:$text-light;	
			font-size:12px;		
			letter-spacing: .1rem;
			text-transform:uppercase;
			cursor:pointer;
		}
	
		.navbar-item.is-active{
			color:$link-active-light;
		}

		 .navbar-item:hover{
			background-color:$text-light;
			color:$text-dark;
		} 
		.navborder span{
			border: 1px solid $brand-primary;
			padding: 10px 25px;
		}

	}

	
	//override some quirk of Bulma that messes with the z-index
	.navbar.is-fixed-top{
		z-index:2;
	}
</style>

		