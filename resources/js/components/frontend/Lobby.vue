<template>
   <div>
    <!-- Lobby Part Start -->
    <section id="lobby_part">
        <div class="row">
            <div class="col-lg-12 main-content-area">


                <LazyVideo style="width:100%; position:relative;" :src="imageUrl+'lobby.mp4'" :poster="imageUrl+'lobby.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

                        <div class="header_ads_one" v-for="(adds, index) in lobbyAds" :key="index">
                            <div class="header_ads_body">
                               <ul class="ads_ul">
                                     <li class="ads_left_li">

                                        <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_left">

                                        <iframe class="iframe_left" :src="adds.ads_position == 4?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                                     </li>

                                     <li class="ads_center_li">
                                             <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_middle">

                                             <iframe class="iframe_middle" :src="adds.ads_position == 2?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>


                                     <li class="ads_right_li">
                                             <img :src="imageUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_right">

                                             <iframe class="iframe_right" :src="adds.ads_position == 3?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                                     </li>

                                 </ul>
                            </div>
                        </div>

                        <div class="lobby_setup">
                            <div class="lobby">
                                <ul>
                                    <li>
                                        <router-link class="lobby_one" :to="user !== null?'/event-room':''">EVENT ROOM</router-link>

                                    </li>

                                    <li>
                                        <router-link class="lobby_two" :to="user !== null?'/exhibition-hall':''">EXHIBITION HALL</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_three" :to="user !== null?'/help-desk':''">HELP DESK</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_four" :to="user !== null?'/webinar':''">WEBINAR</router-link>
                                    </li>

                                    <li>
                                        <router-link class="lobby_five" :to="user !== null?'/blog-page':''">MEDIA CENTER</router-link>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="footer_ads_left_li" v-for="(adds, index) in exhibitionAds" :key="index">
                            <img :src="imageUrl+'bottomleft.png'" alt="ads_banner" class="img-fluid footer_ads_one">

                            <iframe class="iframe_footer_left" :src="adds.ads_position == 5?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>

                        </div>

                        <div class="footer_ads_right_li" v-for="(adds, index) in exhibitionAds" :key="index">
                            <img :src="imageUrl+'bottomright.png'" alt="ads_banner" class="img-fluid footer_ads_two">

                            <iframe class="iframe_footer_right" :src="adds.ads_position == 6?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                        </div>

                         <div class="bto">
                             <router-link to="#">
                                <i class="far fa-comments"></i>
                             </router-link>
<!--
                              <radial-menu
                                style="margin: auto; margin-top: 300px; background-color: white"
                                :itemSize="50"
                                :radius="120"
                                :angle-restriction="180">
                                    <radial-menu-item
                                    v-for="(item, index) in items"
                                    :key="index"
                                    style="background-color: white"
                                    @click="() => handleClick(item)">
                                    <span>{{item}}</span>
                                    </radial-menu-item>
                                </radial-menu>
                            <div style="color: rgba(0,0,0,0.6); margin-top: 16px;">{{ lastClicked }}</div> -->


                        </div>

                <sign-up  :signUp="signUp" :isOtp="isOtp" :trySignIn="trySignIn" id="form" v-if="isSignUp"></sign-up>

                <sign-in class="signin"  :signIn="signIn" :trySignUp="trySignUp" id="form" v-if="isSignIn"></sign-in>

                <otp  id="form" :inputData="inputData" v-if="isOtp" :trySignIn="trySignIn" :email="email" :password="password" :otpStatus="otpStatus" :isOtpFailedMessage="isOtpFailedMessage" :role="role" :otp="otp" :otpVerify="otpVerify" :resentOtp="resentOtp" :isOtp="isOtp" :isResentOtp="isResentOtp" :hasResentOtp="hasResentOtp" :resentOtpLink="resentOtpLink"></otp>


            </div>



        </div>

    </section>
   <!-- Lobby Part Start -->
   </div>
</template>

<script>
import { RadialMenu,  RadialMenuItem } from 'vue-radial-menu'
import { mapGetters } from "vuex";
import VideoLazy from 'vue-lazyload-video'
import SignUp from '../../components/frontend/auth/SignUp'
import SignIn from '../../components/frontend/auth/SignIn'
import Otp from '../../components/frontend/auth/Otp'


export default {

    data(){
        return {
            imageUrl:window.location.origin,
            url:window.location.origin,
            otp:'',
            email:'',
            password:'',
            role:'',
            stallads: {},
            isOtp:false,
            inputData:{},
            isSignIn:false,
            isSignUp:false ,
            isResentOtp:false,
            isOtpFailedMessage:'',
            otpStatus:'',
            hasResentOtp:'',
            isSpin: false,
            items: ['foo', 'bar', 'hello', 'world', 'more', 'items'],
            lastClicked: 'click on something!',
            lobbyAds: {},

        }

    },
    computed:{
        ...mapGetters({
            user:'user'
        })
    },

    components: {
         VideoLazy,
         SignUp,
         Otp,
         SignIn,
         RadialMenu,
         RadialMenuItem
    },
    created() {

        this.imageUrl = this.url+'/frontend/assets/home-images/'

        setTimeout(()=>{
             axios(this.url+'/api/lobby-ads').then(response=>{
                this.lobbyAds = response.data.data;
                console.log('lobbyAds', this.lobbyAds)
            })

        }, 1000)


    },
    mounted(){

        // console.log(this.user.token);

        if(this.user !== null){

            this.isSignIn   = false
            this.isSignUp   = false
            this.isOtp      = false

        } else{

            setTimeout(() => {

            this.isSignUp   = true
        }, 3000)

        }
    },
    methods:{
        handleClick (item) {
            this.lastClicked = item;
        },


        signUp(){

            var form_data = new FormData($('.signup')[0])
            let web_token = localStorage.getItem('web_token')
            form_data.append('web_token', web_token)
            axios.post(this.url+'/api/signup', form_data)
            .then(res => {
                console.log(res.data);
                if(res.data.status == 'success'){

                    this.isSignUp     = false
                    this.isOtp        = true
                    this.otp          = res.data.otp
                    this.email        = res.data.email
                    this.password     = res.data.password
                    this.role         = res.data.role
                    localStorage.setItem('otp', res.data.otp)

                }
            })
            .catch(error =>{

                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('input[name="'+item+'"]')
                        let inputAfter = jQuery(document).find('input[name="'+item+'"] + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')


                    })



                }
            })

        },

        trySignIn(){
            this.isSignIn   = true
            this.isSignUp   = false
            this.isOtp      = false

        },

        trySignUp(){
            this.isSignIn   = false
            this.isSignUp   = true
            this.isOtp      = false

        },


        otpVerify(){

        if(this.isOtp == true){
            var otpForm = new FormData($('.otp')[0])

            var digit_1 = $(document).find('input[name=digit_1]').val();
            var digit_2 = $(document).find('input[name=digit_2]').val();
            var digit_3 = $(document).find('input[name=digit_3]').val();
            var digit_4 = $(document).find('input[name=digit_4]').val();
            var digit_5 = $(document).find('input[name=digit_5]').val();
            var digit_6 = $(document).find('input[name=digit_6]').val();

            var confirm_otp = ''

            if(this.otpStatus == 'success'){

                confirm_otp = this.otp
                $(document).find('input[name=confirm_otp]').val(confirm_otp)

            } else {

                  confirm_otp = $(document).find('input[name=confirm_otp]').val();

            }

            var input_otp = digit_1 + digit_2 + digit_3 + digit_4 + digit_5 + digit_6
            console.log(input_otp);
            // if(confirm_otp == input_otp){
                 let web_token = localStorage.getItem('web_token')
                 otpForm.append('web_token', web_token)
                axios.post(this.url+'/api/otp-verify', otpForm)
                .then(res => {
                    // console.log(res.data.status);

                    if(res.data.status == 'success'){
                        this.isOtp = false,
                        this.isSignUp = false
                        console.log(res.data);
                        window.localStorage.setItem('user', JSON.stringify(res.data))
                        location.reload()
                    }
                })

            // } else {

            //     $('.verification').after('<span class="text-danger">Invalid OTP. Please try again</span>')

            // }
        }

        },

        resentOtpLink(){

        // this.isOtp = false
        this.isResentOtp = true
        $('.resent_otp_number').html('<input name="otp_resent_password" value="'+this.password+'">')

        },

        resentOtp(){

        let form_data = new FormData($('.form')[0])

        axios.post(this.url+'/api/resent-otp', form_data)
        .then(res => {
                console.log(res.data);
            if(res.data.otp_status === 'success'){
                console.log('otp', res.data.otp);
                this.isResentOtp = false
                this.isSignUp    = false
                this.isOtp       = true
                this.hasResentOtp = res.data.otp
                this.otp         = res.data.otp
                this.email       = res.data.email
                this.otpStatus   = res.data.otp_status
                this.role        = res.data.role

            } else {
                // console.log(res.data);
                if(res.data.otp_status == 'failed'){
                    this.otpStatus          = res.data.otp_status
                    this.isOtpFailedMessage = res.data.message
                }


            }

        })
        },

        signIn(){
            let web_token = localStorage.getItem('web_token')

            if(this.isOtp == true){
                this.$store
                .dispatch('signIn', {
                    email:this.email,
                    password:this.password,
                    role:this.role,
                    web_token:web_token


                })
                .the(response => {

                    if(response == undefined){
                        let error_message = JSON.parse(localStorage.getItem('error'));
                        console.log(error_message[0].message);
                        $('.sign_in_error').html('<strong class="text-danger">'+error_message[0].message+'</strong>')
                    }

                })
                .catch(error =>{
                    console.log(error.response.status);

                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('#email')
                        let inputAfter = jQuery(document).find('#password + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')

                    })



                }
            })
            } else {
                let sinInFormData = new FormData($('.signInForm')[0])
                sinInFormData.append('web_token', web_token)

                this.$store.dispatch('signIn', sinInFormData)

                .then(response => {
                    if(response == undefined){
                        let error_message = JSON.parse(localStorage.getItem('error'));
                        console.log(error_message[0].message);
                        $('.sign_in_error').html('<strong class="text-danger">'+error_message[0].message+'</strong>')
                    }

                })
                .catch(error =>{
                if(error.response.status == 422){
                    this.error = error.response.data.errors

                    $.each(error.response.data.errors, function(item,index){
                        let input = jQuery(document).find('#email')
                        let inputAfter = jQuery(document).find('#password + span')

                        input.addClass('is-invalid')

                        inputAfter.remove()
                        input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')

                    })



                }
            })
            }

        },


    }
}
</script>

<style scoped>
.chat{
    z-index: 2147483647;
    position: absolute;
    right: 0;
    /* top:0; */
    bottom: 28%;
}
.li_first_div::after {
    content: "";
    background-color: red;
}

.main-content-area{
    position: relative;
    /* z-index: -1; */
}


.banner_ads_image_left {
    position: relative;
}

.iframe_left {
	position: absolute;
	left: 2.5%;
	top: 1%;
	bottom: 0px;
	right: 0;
	width: 19.2%;
	height: 71%;
}

.banner_ads_image_middle {
    position: relative;
}

.iframe_middle {
	position: absolute;
	width: 24%;
	height: 87%;
	left: 30.2%;
	top: 3%;
}

.banner_ads_image_right {
    position: relative;
}
.iframe_right {
	position: absolute;
	left: 62.7%;
	top: 1%;
	bottom: 0px;
	right: 0;
	width: 18.9%;
	height: 70%;
}

.footer_ads_one {
    position: relative;
}
.footer_ads_two {
    position: relative !important;
}

.iframe_footer_left {
	position: absolute;
	left: 33.3%;
	top: 10%;
	bottom: 0px;
	right: 0;
	width: 28.2%;
	height: 67%;
	transform: rotate(-1deg);
}

.iframe_footer_right {
	position: absolute;
	left: 32.3%;
	top: 9%;
	bottom: 0px;
	right: 0;
	width: 28.2%;
	height: 68%;
	transform: rotate(2deg);
}

    /* Down to top button End */
    .bto[data-v-21a23404] {
        position: fixed !important;
        bottom: 15%;
        right: 3%;
        z-index: 9999;
        cursor: pointer;
    }

    .bto i[data-v-21a23404] {
        width: 60px;
        height: 57px;
        border-radius: 50%;
        background-color: #e23e38;
        color: #fff;
        z-index: 9999;
        line-height: 60px;
        text-align: center;
        font-size: 32px;
    }


</style>
