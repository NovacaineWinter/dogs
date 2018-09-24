		
<template>

    <div id="sign-up-view">
    
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">Your dog is going to love Toys and Treats!</h1>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">

                <div class="columns">                    
                    <div class="column">&nbsp;</div>
                    <div class="column field">
                        <label class="label title has-text-centered">My dog's name is</label>
                        <div class="control">
                            <input 
                                type="text" 
                                class="input" 
                                :class="{'is-danger':errors.dogName}" 
                                @keydown="errors.dogName=false"
                                v-model="dogName"  
                                @keyup="checkIfComplete" 
                                placeholder="Spot....Buster....Rex....">
                            <span class="errortext" v-show="errors.dogName">Required</span>
                        </div>
                    </div>                
                    <div class="column">&nbsp;</div>
                </div>

                <h2 class="title has-text-centered">And they are a..</h2>


                <div class="columns sizeselectors" @click="checkDogDetailsComplete">

                    <div class="column">                        
                        <div class="card" v-bind:class="{ 'is-selected':size==1 }" @click="size=1">
                            <header class="card-header has-text-centered">
                                <p class="card-header-title subtitle">
                                    Small Dog
                                </p>                                
                            </header>
                            <div class="card-image">
                                <div class="pawholder">
                                    <span class="icon smallpaw">
                                        <font-awesome-icon icon="paw" />
                                    </span> 
                                </div>
                            </div>                           
                        </div>
                    </div>

                    <div class="column">                        
                        <div class="card" v-bind:class="{ 'is-selected':size==2 }" @click="size=2">
                            <header class="card-header">
                                <p class="card-header-title subtitle has-text-centered">
                                    Medium Dog
                                </p>                                
                            </header>
                             <div class="card-image">
                                <div class="pawholder">
                                    <span class="icon mediumpaw">
                                        <font-awesome-icon icon="paw" />
                                    </span> 
                                </div>     
                            </div>                           
                        </div>
                    </div>

                    <div class="column">                        
                        <div class="card" v-bind:class="{ 'is-selected':size==3 }" @click="size=3">
                            <header class="card-header">
                                <p class="card-header-title subtitle has-text-centered">
                                    Large Dog
                                </p>                                
                            </header>
                             <div class="card-image">
                                <div class="pawholder">
                                    <span class="icon largepaw">
                                        <font-awesome-icon icon="paw" />
                                    </span> 
                                </div>
                            </div>                             
                        </div>
                    </div> 

                </div>

                <div id="customerDetails">
                    <div v-if="this.size!='' && this.dogName!=''">    

                        <h2 class="title has-text-centered" >About {{ this.dogName }}'s Human...</h2>                    
                        
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
                                                    v-model="firstName" 
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
                                                    v-model="lastName" 
                                                    name="family-name" 
                                                    placeholder="Last Name">
                                                <span class="labeltext" v-show="lastName!=''">Last Name</span>
                                                <span class="errortext" v-show="errors.lastName">Required</span>
                                            </div>
                                        </div>

                                    </div>

                                </div>   

                                <div class="field">
                                    <div class="control">
                                        <input 
                                            type="email" 
                                            class="input"  
                                            :class="{'is-danger':errors.email}" 
                                            @keydown="errors.email=false" 
                                            @keyup="checkIfComplete" 
                                            name="email" 
                                            v-model="email" 
                                            placeholder="Email">
                                        <span class="labeltext" v-show="email!=''">Email</span>
                                        <span class="errortext" v-show="errors.email">Required</span>
                                    </div>                       
                                </div> 

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



                                <div id="addressfields" v-show="fullAddressFields">
                                    <p class="errormessage" v-show="addressErrorMessage!=''">{{this.addressErrorMessage}}</p>
                                    <div class="field">
                                        <div class="control">
                                            <input
                                                type="text" 
                                                class="input"
                                                :class="{'is-danger':errors.lineOne}" 
                                                @keydown="errors.lineOne=false" 
                                                @keyup="checkIfComplete" 
                                                v-model="lineOne" 
                                                name="address-line1" 
                                                placeholder="Address Line 1">
                                            <span class="labeltext" v-show="lineOne!=''">Address Line 1</span>
                                            <span class="errortext" v-show="errors.lineOne">Required</span>
                                        </div>                       
                                    </div> 
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" class="input" v-model="lineTwo" name="address-line2" placeholder="Address Line 2">
                                            <span class="labeltext" v-show="lineTwo!=''">
                                                Address Line 2
                                            </span>
                                        </div>                       
                                    </div> 
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" class="input" v-model="lineThree" name="address-line3" placeholder="Address Line 3">
                                            <span class="labeltext" v-show="lineThree!=''">
                                                Address Line 3
                                            </span>
                                        </div>                       
                                    </div>  
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" class="input" v-model="city" placeholder="City">
                                            <span class="labeltext" v-show="city!=''">
                                                City
                                            </span>
                                        </div>                       
                                    </div>  
                                    <div class="field">
                                        <div class="control">
                                            <input type="text" class="input" v-model="county" placeholder="County">
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
                                            v-model="postcode" 
                                            name="postcode" 
                                            placeholder="Postcode">
                                        <span class="labeltext" v-show="postcode!=''">Postcode</span>
                                        <span class="errortext" v-show="errors.postcode">Required</span>
                                    </div>                       
                                </div> 

                                <div v-show="addressInputPrefs">    
                                    <p style="display:inline-block;padding:6px 0px;cursor:pointer;" @click="manualAddressInput">Enter Address Manually</p>
                                    <div  style="display:inline-block;" @click="openPostcode" :disabled="!filledpostcode" :class="{'is-loading':loadingaddresses}" class="button is-outlined is-primary is-hoverable is-right">Lookup Address</div>
                                </div>
                                

                                <div v-show="showAddressOptions">                                    
                                    <nav class="panel">
                                        <p class="panel-heading">
                                            Select Address
                                        </p> 

                                        <address-row v-for="(addr,index) in this.possibleAddresses" :key="index" :addressstring="addr" @selected="selectAddress"></address-row>
                                    </nav>
                                    <div class="button is-danger is-outlined" @click="manualAddressInput">Not in the list?</div>
                                </div>       

    

                                <div class="button is-outlined is-primary is-right is-large" @click="signMeUp" v-show="fullAddressFields" :disabled="formNotFinished">Subscribe Now</div>


                            </div>  <!-- End of the central column -->
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

            this.stripeHandler = StripeCheckout.configure({
                key: 'pk_test_7rBfXVfqrPbJLePrSN2jJLwo',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token: function(token) {
                    // You can access the token ID with `token.id`.
                    // Get the token ID to your server-side code for use.
                    this.createAccount(token);
                }
            });
        },

        methods:{
            checkDogDetailsComplete(){
                if(this.size!='' && this.dogName!=''){
                    var elemn = document.getElementById("customerDetails");
                    elemn.scrollIntoView({ behavior: 'smooth', block: "start" });                               
                }
            },

            selectAddress(str){
                let data = str.split(',');

                if(data[0] !=' '){
                    this.lineOne = data[0];
                }
                if(data[1] !=' '){
                    this.lineTwo = data[1];
                }
                if(data[2] !=' '){
                    this.lineThree = data[2];
                }

                //line 4
                //locality

                if(data[5] !=' '){
                    this.city = data[5];
                }
                if(data[6] !=' '){
                    this.county = data[6]    
                }  
                this.showAddressOptions=false;
                this.fullAddressFields=true;
                window.scrollTo(0, 0);
                var elemn = document.getElementById("customerDetails");
                elemn.scrollIntoView({  block: "start" });
                this.checkIfComplete();
            },


            problemWithDataRetrival(message){
                    
                this.loadingaddresses = false;  //turn whirlygig off
                this.showAddressOptions = false; //show address selector  
                this.addressInputPrefs = false; //hide the input preference selector
                this.fullAddressFields=true;

                this.possibleAddresses = '';
                //probalby wont echo out the message - won't be user friendly
                this.addressErrorMessage = "We couldn't Find any addresses in that postcode - please fill out your address manually";
            },

            veryifyApiData(data){
                let addresses = data['addresses']
                this.loadingaddresses = false;  //turn whirlygig off
                this.showAddressOptions = true; //show address selector  
                this.addressInputPrefs = false; //hide the input preference selector       

                //deal with multiple addresses in the postcode - typical situation
                if(addresses.length > 1){
                    this.possibleAddresses = addresses;
                    this.addressErrorMessage = '';
                    this.loadingaddresses = false;  //turn whirlygig off
                    this.showAddressOptions = true; //show address selector  
                    this.addressInputPrefs = false; //hide the input preference selector
                }

                //deal with only one address in the postcode
                if(addresses.length == 1){
                    this.selectAddress(addresses[0])
                    this.loadingaddresses = false;  //turn whirlygig off
                    this.showAddressOptions = true; //show address selector  
                    this.addressInputPrefs = false; //hide the input preference selector
                }

                if(addresses.length == 0){
                    this.problemWithDataRetrival();      
                }
            },

            getApiData(postcode){
                //getaddress.io

                let endpoint='https://api.getAddress.io/find/'+postcode+'?api-key=rvBtpEH-nUaFB-VJjC51PQ12935';

                axios.get(endpoint)      
                    .then(response => {this.veryifyApiData(response.data);})

                    .catch(error => {this.problemWithDataRetrival(error.data);});
            },


            doTheChecks(){
                let complete=true;

                if(this.firstName==''){
                    complete=false;                    
                }
                if(this.lastName ==''){
                    complete=false;
                }
                if(this.dogName ==''){
                    complete=false;
                }
                if(this.lineOne ==''){
                    complete=false;
                }
                if(this.postcode ==''){
                    complete=false;
                }
                if(this.email ==''){
                    complete=false;
                }
                if(this.password ==''){
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
                }.bind(this,'this'),500);                
            },


            checkIfPasswordComplete(){
                
                clearTimeout(this.passwordtimeout);

                this.passwordtimeout = setTimeout(function(){

                    if(this.password!='' && this.passwordConfirm!=''){


                        if(this.password != this.passwordConfirm){

                            this.passwordError = true;
                        }else{
                            this.passwordError = false;
                        }


                    }else{
                        this.passwordError = false;
                    }
                    this.checkIfComplete();   

                }.bind(this,'this'),750); 
            },           

            manualAddressInput(){
                this.showAddressOptions = false;
                this.addressInputPrefs = false;
                this.fullAddressFields=true;
                window.scrollTo(0, 0);
                var elemn = document.getElementById("customerDetails");
                elemn.scrollIntoView({  block: "start" });
            },



            openPostcode(){

                if(this.filledpostcode){  
                    
                    this.loadingaddresses=true;     //turn whirlygig on
                    
                    this.getApiData(this.postcode); //make the call - this then manages everything else  
                }   
            },


            highlightMissingFields(){
                let scrollToDogName = false;
                let scrollToCustomer = false;
                if(this.dogName=='') {this.errors.dogName=true;scrollToDogName=true} else {this.errors.dogName=false;}
                if(this.firstName=='') {this.errors.firstName=true;scrollToCustomer=true} else {this.errors.firstName=false;}
                if(this.lastName=='') {this.errors.lastName=true;scrollToCustomer=true} else {this.errors.lastName=false;}
                if(this.lineOne=='') {this.errors.lineOne=true;scrollToCustomer=true} else {this.errors.lineOne=false;}
                if(this.postcode=='') {this.errors.postcode=true;scrollToCustomer=true} else {this.errors.postcode=false;}
                if(this.email=='') {this.errors.email=true;scrollToCustomer=true} else {this.errors.email=false;}
                if(this.password=='') {this.errors.password=true;scrollToCustomer=true} else {this.errors.password=false;}

                if(scrollToDogName){

                    window.scrollTo(0, 0);
                    var elemn = document.getElementById("sign-up-view");
                    elemn.scrollIntoView({  block: "start" });

                }else if(scrollToCustomer){

                    window.scrollTo(0, 0);
                    var elemn = document.getElementById("customerDetails");
                    elemn.scrollIntoView({  block: "start" });
                }
            },

            signMeUp(){
                if(!this.formNotFinished){
                    this.stripeHandler.open({
                        name: 'Toys and Treats',
                        description: 'Monthly Box Delivery',
                        currency: 'gbp',
                        amount: 999,
                        email: this.email,
                        allowRememberMe:false,
                      });
                }else{
                    this.highlightMissingFields();                   
                }
            },


            createAccount(stripePayload){



                axios.post('/api/create-new-user',{field:'value'})      
                    .then(response => {alert(response.data);})
        
                    .catch(error => {alert(error.data);});
                
                
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
                dogName:'',
		        size:'',
                lineOne:'',
                lineTwo:'',
                lineThree:'',
                city:'',
                county:'',
                postcode:'',
                firstName:'',
                lastName:'',
                email:'',
                possibleAddresses:'',
                showAddressOptions:false,
                addressInputPrefs:true,
                fullAddressFields:false,
                loadingaddresses:false,
                addressErrorMessage:'',
                apiData:'',
                formNotFinished:true,
                password:'',
                passwordConfirm:'',
                keytimeout:'',
                passwordtimeout:'',
                passwordError:false,
                stripeHandler:'',
                errors:{
                    firstName:false,
                    lastName:false,
                    email:false,
                    password:false,
                    lineOne:false,
                    email:false,
                    dogName:false
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
   
    #sign-up-view{   
        .button{
            cursor:pointer;
        }

        .errormessage{
            color:$brand-danger;
            padding:5px;
            background-color:$brand-danger-background;
            text-align:center;
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
        .sizeselectors{
            span.icon{
                padding-left:50%;
            }
            .card-header-title{
                display:initial;
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

</style>

		