		
<template>

    <div id="sign-up-view">
    
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">Your dog is going to love Toys and Treats!</h1>
                </div>
            </div>
        </section>

       <!--  <section class="section">
           <div class="container">
               <div class="columns plan-options">
                   <div class="column" v-for="plan in plans" :key="plan.id" @click="selectedPlan(plan)">
                       <div class="card" :class="{'is-selected':plan.id == planSelected.id}">
                           <header class="card-header has-text-centered">
                               <p class="card-header-title subtitle" v-text="plan.title"></p>
                           </header>
                           <div class="card-content is-flex" :class="plan.size">                                
                               <img :src="plan.img" class="is-horisontal-center" alt="plan image">
                           </div>
                           <div class="button is-outlined is-primary is-centered">Select</div>
                           <div class="card-content has-text-centered"> 
                               <p class="title" v-text="plan.price_string"></p>
                           </div>
                           <div class="card-content has-text-centered"> 
                               <p v-text="plan.description"></p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section> -->

        <section class="section" id="dogNameAndSize">
            <div class="container">
    

                <div class="columns">
                    <div class="column"></div>
                    <div class="column is-8">                       
                        <div class="columns has-border is-selected is-mobile">
                            <div class="column is-2"><img :src="planimage" class="is-horisontal-center" alt="plan image"></div>
                            <div class="column columns">                            
                                <div class="column is-9">
                                    <h1 class="subtitle">
                                        Toys and Treats Box                                
                                    </h1>
                                    <p>
                                        A surprise box filled with doggie fun and happiness. Delivered to your pampered pooch every four weeks. Get those tails wagging!<br><br>                             
                                    </p>   
                                    <p class="has-text-centered"> Next box is dispatched on <span v-text="nextDispatch"></span></p>
                                </div>
                                <div class="column is-3 has-text-centered">£14.97 / Box Delivered every 4 weeks</div>
                            </div>
                        </div>                    
                    </div>
                    <div class="column"></div>
                </div>


                <div v-show="showDogDetails">
                    
                    <div class="columns">
                        <div class="column blankcolumn">&nbsp;</div>
                        <div class="column field">
                            <h1 class="subtitle has-text-centered" v-if="dogName==''"><br><br>Fill out your dog's name to get started...</h1>
                            <label class="label title has-text-centered">My dog's name is</label>
                            <div class="control">
                                <input 
                                    type="text" 
                                    class="input" 
                                    :class="{'is-danger':errors.dogName}" 
                                    @keydown="errors.dogName=false"
                                    v-model="dogName"  
                                    @keyup.tab="dogNameTabbed"
                                    @keyup="dogNameInputKeyup" 
                                    placeholder="Spot....Buster....Rex....">
                                <span class="errortext" v-show="errors.dogName">Required</span>
                            </div>
                        </div> 

                        <div class="column blankcolumn">&nbsp;</div>
                    </div>


                    <div v-show="showSizeSelector">                    
                        <h2 class="title has-text-centered">And they are a..</h2>


                        <div class="columns is-mobile sizeselectors" @click="dogSizeSelected">

                            <div class="column">                        
                                <div class="card" v-bind:class="{ 'is-selected':dogSize==1 }" @click="dogSize=1">
                                    <header class="card-header has-text-centered">
                                        <p class="card-header-title subtitle">
                                            Small<br>Dog
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
                                <div class="card" v-bind:class="{ 'is-selected':dogSize==2 }" @click="dogSize=2">
                                    <header class="card-header">
                                        <p class="card-header-title subtitle has-text-centered">
                                            Medium<br>Dog
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
                                <div class="card" v-bind:class="{ 'is-selected':dogSize==3 }" @click="dogSize=3">
                                    <header class="card-header">
                                        <p class="card-header-title subtitle has-text-centered">
                                            Large<br>Dog
                                        </p>                                
                                    </header>
                                     <div class="card-image">
                                        <div class="pawholder">                                    
                                            <span class="icon largepaw">
                                                <font-awesome-icon icon="paw" />
                                            </span> 
                                            <br><br>
                                        </div>
                                    </div>                             
                                </div>
                            </div> 

                        </div>
                    </div>
                </div>

                <div id="customerDetails">
                    <div v-if="this.dogSize!='' && this.dogName!=''">    

                        <h2 class="title has-text-centered textcaptialised" >About {{ this.dogName }}'s Human...</h2>                    
                        
                        <div class="columns">
                            <div class="column blankcolumn">&nbsp;</div>
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

                                    <a href="/login" class="errormessage" v-show="errors.emailTaken">This email is already registed, click here log in</a>
                                
                                    <div class="control">
                                        <input 
                                            type="email" 
                                            class="input"  
                                            :class="{'is-danger':errors.email}" 
                                            @keydown="errors.email=false" 
                                            @keyup="checkIfEmailComplete" 
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

    

                                <div class="button is-outlined is-primary is-right is-large" :class="{'is-loading':loadingSubButton}" @click="signMeUp" v-show="fullAddressFields" :disabled="formNotFinished">Subscribe Now</div>


                            </div>  <!-- End of the central column -->
                            <div class="column blankcolumn">&nbsp;</div>
                        </div>

                    </div>
                    
                </div>


                <div id="loadingscreen" v-show="showLoading">
                    <div class="container">
                        <div class="columns">
                            <div class="column blankcolumn">&nbsp;</div>
                            <div class="column">                                
                                <h1 class="title has-text-centered">Loading...</h1>
                                <div class="button is-loading is-primary is-outlined is-large">&nbsp;</div>
                            </div>
                            <div class="column blankcolumn">&nbsp;</div>
                        </div>
                    </div>
                </div> 

                <div id="problemScreen" v-show="showErrorScreen" @click="showErrorScreen=false">
                    <div class="container">
                        <div class="columns">
                            <div class="column blankcolumn">&nbsp;</div>
                            <div class="column">                                
                                <h1 class="title has-text-centered">There was a problem...</h1>
                                <p class="subtitle has-text-centered" v-text="errors.message"></p>
                                <router-link to="/contact-us" tag="div" class="button is-primary is-outlined is-large">Contact Us</router-link>
                            </div>
                            <div class="column blankcolumn">&nbsp;</div>
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

            axios.get('/api/plans')      
                .then(response => {
                    this.plans = response.data;
                    this.selectedPlan(response.data[0]);
                    this.planimage=this.planSelected.img;
                })
    
                .catch(error => {console.log(error.data)});
            

             axios.get('/api/new-user-next-dispatch')      
                .then(response => {
                    this.nextDispatch = response.data; 
                })
    
                .catch(error => {console.log(error.data)});
            
            axios.get('/api/get-stripe-public-key')      
                .then(response => {

                    this.stripeHandler = StripeCheckout.configure({
                        key: response.data,
                        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                        locale: 'auto',
                        token: function(context,token) {
                            // You can access the token ID with `token.id`.
                            // Get the token ID to your server-side code for use.
                            
                            this.createAccount(token);
                        }.bind(this,'this')
                    });
                    

                })
                
            
                .catch(error => {
                    this.showErrorScreen = true;
                });
        
        },

        methods:{
            selectedPlan(plan){
                this.planSelected = plan;
                this.showDogDetails = true;
                /*window.scrollTo(0, 0);
                var elemn = document.getElementById("dogNameAndSize");
                elemn.scrollIntoView({ behavior: 'smooth', block: "start" });   */
            },

            dogNameInputKeyup(event){
                clearTimeout(this.dogNameTimeout);

                this.dogNameTimeout = setTimeout(function(){
                    if(this.dogName !=''){
                        this.showSizeSelector = true;
                    }else{
                        this.showSizeSelector = false;
                    }
                }.bind(this,'this'),750);
            },

            dogNameTabbed(){
                console.log('tabed');
            },

            dogSizeSelected(){
                var elemn = document.getElementById("customerDetails");
                elemn.scrollIntoView({ behavior: 'smooth', block: "start" });
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


            checkIfEmailComplete(){
                this.errors.emailTaken=false;
                clearTimeout(this.emailtimeout);

                this.emailtimeout = setTimeout(function(){
                    //check the email isnt already taken
                    axios.post('/api/checkemail',{email:this.email})      
                        .then(response => {this.errors.emailTaken=false;})
            
                        .catch(error => {this.errors.emailTaken=true;});

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
                    this.doTheChecks();  

                }.bind(this,'this'),1000); 
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
                    this.loadingSubButton=true;
                    this.stripeHandler.open({
                        name: this.planSelected.title,
                        description: 'Monthly Box Delivery',
                        currency: 'gbp',
                        amount: this.planSelected.amount,
                        email: this.email,
                        allowRememberMe:false,
                      });                    
                }else{
                    this.highlightMissingFields();                   
                }
            },


            createAccount(stripePayload){     
                this.showLoading = true;
                axios.post('/api/create-new-user',{
                    stripeData:stripePayload,
                    dogName:this.dogName,
                    dogSize:this.dogSize,
                    lineOne:this.lineOne,
                    lineTwo:this.lineTwo,
                    lineThree:this.lineThree,
                    city:this.city,
                    county:this.county,
                    postcode:this.postcode,
                    firstName:this.firstName,
                    lastName:this.lastName,
                    email:this.email,
                    password:this.password,
                    planSelected:this.planSelected.id
                })      
                    .then(response => {this.redirectAndLogIn(response.data);})
        
                    .catch(error => {this.manageRegistrationError(error);});                
                
            },


            redirectAndLogIn(response){

                if(response.status=='subscribed'){
                    this.logmein();
                }else{
                    this.errors.message='there was a problem creating your account - please get in touch with us on the contact us page';
                    this.showErrorScreen = true;
                }

            },

            manageRegistrationError(error){
                this.showLoading=false;
                console.log('signup error - ',error);
                this.errors.message='there was a problem creating your account - please get in touch with us on the contact us page';
                this.showErrorScreen = true;
            },

            logmein(){

                var form = document.createElement("form");
                var element1 = document.createElement("input"); 
                var element2 = document.createElement("input");  
                var element3 = document.createElement("input");  
                var element4 = document.createElement("input");  

                form.method = "POST";
                form.action =  document.head.querySelector("[property=siteurl]").content +"/login";   

                element1.value=this.email;
                element1.name="email";
                element1.type="email";
                form.appendChild(element1);  

                element2.value=this.password;
                element2.name="password";
                element2.type="password";
                form.appendChild(element2);                

                element3.value=this.$root.csrf;
                element3.name="_token";
                element3.type="hidden";
                form.appendChild(element3);  

                element4.value=1;
                element4.name="remember";
                element4.type="checkbox";
                form.appendChild(element4);

                document.body.appendChild(form);

                form.submit();
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
		        dogSize:'',
                lineOne:'',
                lineTwo:'',
                lineThree:'',
                city:'',
                county:'',
                postcode:'',
                firstName:'',
                lastName:'',
                email:'',
                password:'',
                passwordConfirm:'',
                possibleAddresses:'',
                plans:{},
                planSelected:{},
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
                planimage:'/img/box.png',
                nextDispatch:'',
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
   
    .has-border{
        border:1px solid $text-dark;
        border-radius:5px;
    }
    

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
    #problemScreen{
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
    

        .button.is-centered{
            margin-left:42%;
        }


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


    @media only screen and (max-width: 768px) {

        #dogNameAndSize{
            padding-top:0px;
        }  

        .blankcolumn{
            display:none;
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

		