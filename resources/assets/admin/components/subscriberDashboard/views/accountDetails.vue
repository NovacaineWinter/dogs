        
<template>

    <div id="sign-up-view">
        <dash-tabs></dash-tabs>
        <h1 class="title">Account Details</h1>    
            
       

        <section class="section">
            <div class="container"> 

                <div id="customerDetails">
                    
                    <div class="columns">
                        <div class="column">&nbsp;</div>
                        <div class="column">                               

                            <div class="field">

                                <div class="columns">

                                    <div class="column">
                                        <div class="control"> 

                                            <input 
                                                type="text" 
                                                class="input" 
                                                :class="{'is-danger':errors.firstName}" 
                                                @keydown="errors.firstName=false"  
                                                @keyup="checkIfComplete" 
                                                v-model="$root.user.firstName" 
                                                name="name" 
                                                placeholder="First Name">
                                            <span class="labeltext" v-show="firstName!=''">
                                                First Name
                                            </span>
                                            <span class="errortext" v-show="errors.firstName">Required</span>
                                        </div>                                    
                                    </div>



                                    <div class="column">                                    
                                        <div class="control">                                
                                            <input 
                                                type="text" 
                                                class="input" 
                                                :class="{'is-danger':errors.lastName}" 
                                                @keydown="errors.lastName=false" 
                                                @keyup="checkIfComplete" 
                                                v-model="$root.user.lastName" 
                                                name="family-name" 
                                                placeholder="Last Name">
                                            <span class="labeltext" v-show="lastName!=''">Last Name</span>
                                            <span class="errortext" v-show="errors.lastName">Required</span>
                                        </div>
                                    </div>

                                </div>

                            </div>                              
<!-- 
                            <div class="field">

                                <p class="errormessage" v-show="passwordError">Passwords do not match</p>

                                <div class="columns">

                                    <div class="column">
                                        <div class="control">                                
                                            <input 
                                                type="password" 
                                                class="input" 
                                                :class="{'is-danger':errors.email || passwordError}" 
                                                @keydown="errors.email=false"                                                     
                                                @keyup="checkIfPasswordComplete" 
                                                v-model="password" 
                                                name="password" 
                                                placeholder="Password">
                                            <span class="labeltext" v-show="password!=''">Password</span>
                                            <span class="errortext" v-show="errors.password">Required</span>
                                        </div>                                    
                                    </div>

                                    <div class="column">                                    
                                        <div class="control">                                
                                            <input type="password" class="input" :class="{'is-danger':passwordError}" @keyup="checkIfPasswordComplete" v-model="passwordConfirm"  placeholder="Confirm Password">
                                            <span class="labeltext" v-show="passwordConfirm!=''">
                                                Confirm Password
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>


 -->
                            <div id="addressfields">
                                <p class="errormessage" v-show="addressErrorMessage!=''">{{this.addressErrorMessage}}</p>
                                <div class="field">
                                    <div class="control">
                                        <input
                                            type="text" 
                                            class="input"
                                            :class="{'is-danger':errors.lineOne}" 
                                            @keydown="errors.lineOne=false" 
                                            @keyup="checkIfComplete" 
                                            v-model="$root.user.lineOne" 
                                            name="address-line1" 
                                            placeholder="Address Line 1">
                                        <span class="labeltext" v-show="lineOne!=''">Address Line 1</span>
                                        <span class="errortext" v-show="errors.lineOne">Required</span>
                                    </div>                       
                                </div> 
                                <div class="field">
                                    <div class="control">
                                        <input type="text" class="input" v-model="$root.user.lineTwo" name="address-line2" placeholder="Address Line 2">
                                        <span class="labeltext" v-show="lineTwo!=''">
                                            Address Line 2
                                        </span>
                                    </div>                       
                                </div> 
                                <div class="field">
                                    <div class="control">
                                        <input type="text" class="input" v-model="$root.user.lineThree" name="address-line3" placeholder="Address Line 3">
                                        <span class="labeltext" v-show="lineThree!=''">
                                            Address Line 3
                                        </span>
                                    </div>                       
                                </div>  
                                <div class="field">
                                    <div class="control">
                                        <input type="text" class="input" v-model="$root.user.city" placeholder="City">
                                        <span class="labeltext" v-show="city!=''">
                                            City
                                        </span>
                                    </div>                       
                                </div>  
                                <div class="field">
                                    <div class="control">
                                        <input type="text" class="input" v-model="$root.user.county" placeholder="County">
                                        <span class="labeltext" v-show="county!=''">
                                            County
                                        </span>
                                    </div>                       
                                </div>   
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input 
                                        type="text" 
                                        class="input"
                                        :class="{'is-danger':errors.postcode}" 
                                        @keydown="errors.postcode=false" 
                                        @keyup="checkIfComplete" 
                                        v-model="$root.user.postcode" 
                                        name="postcode" 
                                        placeholder="Postcode">
                                    <span class="labeltext" v-show="postcode!=''">Postcode</span>
                                    <span class="errortext" v-show="errors.postcode">Required</span>
                                </div>                       
                            </div> 
                            

                           

                            <div class="button is-outlined is-primary is-right is-large" :class="{'is-loading':loadingSubButton}" @click="updateUser" :disabled="formNotFinished">Update</div>


                        </div>  <!-- End of the central column -->
                        <div class="column">&nbsp;</div>
                    </div>                    
                </div>


                <div id="loadingscreen" v-show="showLoading">
                    <div class="container">
                        <div class="columns">
                            <div class="column">&nbsp;</div>
                            <div class="column">                                
                                <h1 class="title has-text-centered">Loading...</h1>
                                <div class="button is-loading is-primary is-outlined is-large">&nbsp;</div>
                            </div>
                            <div class="column">&nbsp;</div>
                        </div>
                    </div>
                </div> 

                <div class="modalScreen" v-show="showErrorScreen" @click="errorAcknowleged">
                    <div class="container">
                        <div class="columns">
                            <div class="column">&nbsp;</div>
                            <div class="column">                                
                                <h1 class="title has-text-centered">There was a problem...</h1>
                                <p class="subtitle has-text-centered" v-text="errors.message"></p>
                                <div @click="errorAcknowleged" class="button is-primary is-outlined is-large">Ok</div>
                            </div>
                            <div class="column">&nbsp;</div>
                        </div>
                    </div>
                </div>

                <div class="modalScreen" v-show="showCompleteScreen" @click="showCompleteScreen=false">
                    <div class="container">
                        <div class="columns">
                            <div class="column">&nbsp;</div>
                            <div class="column">                                
                                <h1 class="title has-text-centered">Account Updated</h1>                                
                                <router-link to="/" tag="div" class="button is-primary is-outlined is-large">Continue</router-link>
                            </div>
                            <div class="column">&nbsp;</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


    </div>



</template>

<script>

    import _ from 'lodash'

    export default {
    
        mounted() {                    
            setTimeout( () => { window.scrollTo(0, 0);}, 10);
            this.checkIfComplete();
        },

        methods:{
                     
            errorAcknowleged(){
                this.showErrorScreen=false;
                this.loadingSubButton=false;
            },

          
            doTheChecks(){
                let complete=true;

                if(this.$root.user.firstName==''){
                    complete=false;                    
                }
                if(this.$root.user.lastName ==''){
                    complete=false;
                }
                if(this.$root.user.lineOne ==''){
                    complete=false;
                }
                if(this.$root.user.postcode ==''){
                    complete=false;
                }  

                if(complete){  
                    this.formNotFinished = false;                  
                }else{
                    this.formNotFinished = true;                   
                }     
            },

            checkIfComplete(){
                clearTimeout(this.keytimeout);

                this.keytimeout = setTimeout(function(){
                    this.doTheChecks();
                    this.highlightMissingFields();
                }.bind(this,'this'),500);                
            },


            highlightMissingFields(){

                let scrollToCustomer = false;               
                if(this.$root.user.firstName=='') {this.errors.firstName=true;scrollToCustomer=true} else {this.errors.firstName=false;}
                if(this.$root.user.lastName=='') {this.errors.lastName=true;scrollToCustomer=true} else {this.errors.lastName=false;}
                if(this.$root.user.lineOne=='') {this.errors.lineOne=true;scrollToCustomer=true} else {this.errors.lineOne=false;}
                if(this.$root.user.postcode=='') {this.errors.postcode=true;scrollToCustomer=true} else {this.errors.postcode=false;}               

                if(scrollToCustomer){

                    window.scrollTo(0, 0);
                    var elemn = document.getElementById("customerDetails");
                    elemn.scrollIntoView({  block: "start" });
                }
            },


            updateUser(){
                if(!this.formNotFinished){
                    this.loadingSubButton=true;
                    console.log(this.$root.user);
                    axios.post('/api/update-user',{
                        userId:this.$root.user.id,
                        firstName:this.$root.user.firstName,
                        lastName:this.$root.user.lastName,
                        lineOne:this.$root.user.lineOne,
                        lineTwo:this.$root.user.lineTwo,
                        lineThree:this.$root.user.lineThree,
                        city:this.$root.user.city,
                        county:this.$root.user.county,
                        postcode:this.$root.user.postcode
                    }) 

                        .then(response => {this.showCompleteScreen=true})

                        .catch(error => {this.errors.message='There was an error updating your account, please try again';this.showErrorScreen=true;});               
                      
                }else{
                    this.highlightMissingFields();                   
                }
            },


          



        },

        computed:{
            filledpostcode(){
                if(this.postcode==''){
                    return false;
                }else{
                    return true;
                }
            },          
        },

        data: function() {
            return{               
                lineOne:this.$root.user.lineOne,
                lineTwo:this.$root.user.lineTwo,
                lineThree:this.$root.user.lineThree,
                city:this.$root.user.city,
                county:this.$root.user.county,
                postcode:this.$root.user.postcode,
                firstName:this.$root.user.firstName,
                lastName:this.$root.user.lastName,
     
                showCompleteScreen:false,
                showSizeSelector:false,
                dogNameTimeout:{},
                showDogDetails:false,
                showAddressOptions:false,
                addressInputPrefs:true,
                fullAddressFields:false,
                loadingaddresses:false,
                addressErrorMessage:'',
                apiData:'',
                formNotFinished:true,
                keytimeout:'',
                passwordtimeout:'',
                passwordError:false,
                stripeHandler:'',
                loadingSubButton:false,
                showLoading:false,
                showErrorScreen:false,
                errors:{
                    firstName:false,
                    lastName:false,
                    email:false,
                    password:false,
                    lineOne:false,
                    email:false,
                    dogName:false,
                    emailTaken:false,
                    message:'',

                }
              }
        },
/*
        props: [
            'propsPassed'
        ], */

    };
</script>



<style lang="scss">
    @import '~sass/variables';
   

    .textcaptialised{
        text-transform:capitalize;
    }

    #loadingscreen{
        position:fixed;
        width:100vw;
        height:100vh;
        top:0px;
        left:0px;
        padding:0px;
        margin:0px;
        background-color:rgba(255,255,255,0.7);
        z-index:100;

        .container{
            display: flex;
            align-items: center;
            justify-content: center;            
        }

        .columns{
            margin-top: 20%;
            padding: 5%;
            border: 1px solid $text-dark;
            background-color: #fff;
        }
        .button{
            width:100%;
        }

    }

    .modalScreen{
        position:fixed;
        width:100vw;
        height:100vh;
        top:0px;
        left:0px;
        padding:0px;
        margin:0px;
        background-color:rgba(255,255,255,0.7);
        z-index:100;

        .container{
            display: flex;
            align-items: center;
            justify-content: center;            
        }

        .columns{
            margin-top: 20%;
            padding: 5%;
            border: 1px solid $text-dark;
            background-color: #fff;
        }       
        .button{
            width:100%;
            margin-top:20px;
        }

    }

    #sign-up-view{   
    
        padding-bottom:50vh;
            
        .plan-options{
            .small{
                img{
                    width:30%;            
                    margin-top:20%;
                    margin-bottom:20%;
                    margin-left:35%;
                }
            }
            .medium{
                img{
                    width:50%;
                    margin-top:10%;
                    margin-bottom:10%;
                    margin-left:25%;
                }
            }
            .large{
                img{
                    width:70%;
                    margin-left:15%;
                }
            }

            .column{
                max-width:32%;
                margin-left:33%;
            }
        }
    

        .button{
            cursor:pointer;
        }

        .is-horisontal-center{
            justify-content: center;
        }

        .errormessage{
            color:$brand-danger;
            padding:5px;
            background-color:$brand-danger-background;
            text-align:center;
            display:block;
            margin-bottom:15px;
        }

        .control{
            position:relative;
            .labeltext{
                position: absolute;
                left: 15px;
                top: -13px;
                background-color: #fff;
                padding-left: 3px;
                padding-right: 3px;
                color:#999999;
            }
            .errortext{
                position: absolute;
                right: 15px;
                top: -13px;
                background-color: #fff;
                padding-left: 3px;
                padding-right: 3px;
                color:$brand-danger;
            }
        }

        .field{
            margin-top:30px;
        }




        #customerDetails{
            padding-top:100px;
            .is-right{
                float:right;
            }
        }     

        .card{
            cursor:pointer;
            border-radius:10px;
        }

        .card:hover{
            background-color:#ccf5ef;
        }

        .pawholder{
            color:#353535;
        }

        .smallpaw{
            font-size:4vw;
            margin-top:6vw;
        }
        .mediumpaw{
            font-size:8vw;        
            margin-top:6vw;
        }
        .largepaw{
            font-size:12vw;
            margin-top:6vw;
        }

        .is-selected{
            box-shadow: 0px 0px 20px #00d1b2;
            .pawholder{
                color:#00d1b2;
            }
        }
        .card-header-title{
            display:initial;
        }
        .sizeselectors{
            span.icon{
                padding-left:50%;
            }
        }
        .pawholder{
            height:14vw;
        }


        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #000;
        }
        ::-moz-placeholder { /* Firefox 19+ */
            color: #000;
        }
        :-ms-input-placeholder { /* IE 10+ */
            color: #000;
        }
        :-moz-placeholder { /* Firefox 18- */
            color: #000;
        }

    }



    @media only screen and (max-width: $tabletbreak) {
        #sign-up-view{
            .sizeselectors{
                .card-header-title {
                    font-size:3vw;
                }   
            } 

            .pawholder{
                height:18vw;
            }

            .title{
                font-size:4vw;
            }
        }
    }


    @media only screen and (max-width: $phonebreak) {
       
    }
</style>

        