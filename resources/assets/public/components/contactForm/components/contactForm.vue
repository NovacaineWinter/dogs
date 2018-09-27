		
<template>
	<div class="contactform" >

        <div v-if="messageSentOk">
            <p class="title has-text-centered">Your Message Has Been Submitted</p>
            <i class="fas fa-check"></i>
        </div>



        <div v-if="!messageSentOk" @keydown="errors.clear($event.target.name)">
            <p class="title has-text-centered">Send a Message</p>

    <!-- First Name -->
            <input 
                :class="{'is-danger':errors.has('fname'), 'is-info':!errors.has('fname')}"
                class="input" 
                type="text" 
                name="fname" 
                v-model="fname" 
                placeholder="First Name">
            <span v-if="errors.has('fname')" class="help is-danger" v-text="errors.get('fname')"></span>


    <!-- Last Name -->
            <input 
                :class="{'is-danger':errors.has('lname'), 'is-info':!errors.has('lname')}"
                class="input" 
                type="text" 
                name="lname" 
                v-model="lname" 
                placeholder="Last Name">
            <span v-if="errors.has('lname')" class="help is-danger" v-text="errors.get('lname')"></span>


    <!-- Email -->
            <input 
                :class="{'is-danger':errors.has('email'), 'is-info':!errors.has('email')}" 
                class="input" 
                type="text" 
                name="email" 
                v-model="email" 
                placeholder="Email">            
            <span v-if="errors.has('email')" class="help is-danger" v-text="errors.get('email')"></span>


    <!-- Message -->
            <textarea 
                :class="{'is-danger':errors.has('message'), 'is-info':!errors.has('message')}" 
                class="textarea" 
                name="message" 
                v-model="message" 
                rows="10" 
                placeholder="Message...">            
            </textarea>
            <span v-if="errors.has('message')" class="help is-danger" v-text="errors.get('message')"></span>


    <!-- Submit -->
            <div 
            class="button is-pulled-right is-info is-outlined" 
            :class="{ 'is-loading': messageSending}" 
            @click="sendMessage"
            :disabled="errors.any()"
            >
                Send
            </div>

        </div>

    </div>
   
</template>

<script>

    import endpoints from '../endpoints.js';   //relative path - beware
    import Errors from '../../../setup/externalClasses.js';
    export default {

        methods:{
            sendMessage(){
                if(!this.errors.any()){
                    this.messageSending = true;

                    axios.post(endpoints.recieveMessage,this.payload)      
                        .then(response => {this.messageSending=false;this.messageSentOk=true})

                        .catch(error => {this.messageSending=false;this.errors.record(error.response.data.errors);});

                }
            },
        },

        computed:{
        	payload(){
                return {
                    fname:this.fname,
                    lname:this.lname,
                    email:this.email,
                    message:this.message                    
                }      		
        	},        	
        },

        data: function() {
		    return{
		        fname:null,
                lname:null,
                email:null,
                message:'',	
                messageSentOk:false,	
                messageSending:false,   
                errors: new Errors(),
                submitDisabled:false   
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
    .contactform{
        width:50%;
        margin:auto;
        input{
            display:block;
            width:100%;
            margin:20px auto; 
            font-size:16px;

        };
        textarea.textarea{
            width:100%;
            margin-left:0%;
            display:block;
            min-width:20%;
        }
        .button.is-pulled-right{
            margin-right:10%;
        }

        span.help{
            margin-left:25%;
            margin-bottom: 20px;
        }

        .fa-check{
            color:$brand-success;
            font-size:70px;
            margin-left:47%;
        }
    }
@media only screen and (max-width: $tabletbreak){
    .contactform{
        width:80%;
    }
}
</style>

		