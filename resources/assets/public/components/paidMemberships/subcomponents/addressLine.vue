		
<template>
    <a class="panel-block" v-on:click="$emit('selected',addressstring)" v-on:mouseover="mouseover" v-on:mouseout="mouseout" v-bind:class="{'is-active':active}">
        {{stringToShow}}
    </a>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {

        methods:{
            mouseover(){
                this.active=true;
            },

            mouseout(){
                this.active=false;
            },
        },

        computed:{
            stringToShow(){
                let arrayOfNonEmpties = []
                this.addressstring.split(',').forEach(function(element){
                    if(element != ' '){
                        arrayOfNonEmpties.push(element);
                    }
                });

                return arrayOfNonEmpties.join();

            }
        },
        data: function() {
		    return{
		        active:false,		        
		      }
	    },

	    props: [
		    'addressstring'
	    ],
    };
</script>



<style lang="scss">
    //@import '~sass/variables';

</style>

		