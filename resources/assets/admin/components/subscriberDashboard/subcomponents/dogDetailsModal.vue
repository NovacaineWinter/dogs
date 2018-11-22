        
<template>

    <div class="modal dogdetailmodal">

        <div class="modal-background" @click="blurred"></div>
        <button class="modal-close is-large" aria-label="close" @click="$emit('closeModal')"></button>

        <div class="modal-content box">
            <h1 class="title">Change Dog Details</h1>
            <div class="field">
                <label class="label title has-text-centered">My dog's name is</label>
                <div class="control">
                    <input 
                        type="text" 
                        class="input" 
                        v-model="dogDetails.dog_name"  
                        placeholder="Spot....Buster....Rex...."
                        @keyup="changed=true">
                </div>
            </div>                
                               
            <h2 class="title has-text-centered">And they are a..</h2>


            <div class="columns is-mobile sizeselectors" @click="changed=true">

                <div class="column dogsizecolumn">                        
                    <div class="card" v-bind:class="{ 'is-selected':dogDetails.dog_size==1 }" @click="dogDetails.dog_size=1">
                        <header class="card-header">
                            <p class="card-header-title subtitle  has-text-centered">
                                Small<br>Dog
                            </p>                                
                        </header>                                          
                    </div>
                </div>

                <div class="column dogsizecolumn">                        
                    <div class="card" v-bind:class="{ 'is-selected':dogDetails.dog_size==2 }" @click="dogDetails.dog_size=2">
                        <header class="card-header">
                            <p class="card-header-title subtitle has-text-centered">
                                Medium<br>Dog
                            </p>                                
                        </header>                                           
                    </div>
                </div>

                <div class="column dogsizecolumn">                        
                    <div class="card" v-bind:class="{ 'is-selected':dogDetails.dog_size==3 }" @click="dogDetails.dog_size=3">
                        <header class="card-header">
                            <p class="card-header-title subtitle has-text-centered">
                                Large<br>Dog
                            </p>                                
                        </header>                                 
                    </div>
                </div> 
            </div>
            <div class="button is-info is-right is-large is-outlined" @click="saveDetails">Save</div>
        </div>
    </div>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {

        methods:{
            saveDetails(){
                axios.post('/api/update/dog-details',{dog_name:this.dogDetails.dog_name,dog_size:this.dogDetails.dog_size,sub_id:this.sub.id})      
                    .then(response => {this.$emit('detailsChanged',this.dogDetails);this.changed=false;})

                    .catch(error => {console.log('there was an error updating your information')});  
            },
            blurred(){
                if(!this.changed){
                    this.$emit('closeModal');
                }
            },
        },

        data: function() {
            return{
                dogDetails:{
                    dog_name:this.sub.dog_name,
                    dog_size:this.sub.dog_size
                }, 
                changed:false,           
              }
        },

        props: [
            'sub'
        ], 

    };
</script>



<style lang="scss">
    @import '~sass/variables';

    .dogdetailmodal{

        .title{
            margin-top:40px;
        }
        .is-right{
            float:right;
        }

        .dogsizecolumn{
            cursor:pointer;
            .card:hover{
                box-shadow: 0px 0px 20px #353535;
            }
            .has-text-centered{
                padding:20px 0px;
            }
        }

        .has-text-centered{
            justify-content: center;
        }

        .is-selected{
            box-shadow: 0px 0px 20px #00d1b2;
            color:#00d1b2;
            .card-header-title{
                color:#00d1b2;
            }
        }
      
    }

</style>

        