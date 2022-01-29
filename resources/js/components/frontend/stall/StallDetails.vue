<template>

  <div>
         <!-- Lobby Part Start -->


            <section id="stalllayout_part">
                <LazyVideo style="width:100%; position:relative; height:80%; height: 1050px; object-fit: cover;" :src="imageUrl+'exibitionhall.mp4'" :poster="imageUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>
                <div class="stall_layout">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- v-for="(adds, index) in stallads" :key="index" -->

                            <p class="text-light" v-for="(adds, index) in stallads" :key="index">

                                <img :src="adds.ads_position == 3?adds.image:''" class="img-fluid stall_banner_left">
                                <img :src="adds.ads_position == 4?adds.image:''" class="img-fluid stall_banner_right">
                                <img :src="adds.ads_position == 5?adds.image:''" class="img-fluid stall_banner_right_two">
                                <img :src="adds.ads_position == 6?adds.image:''" class="img-fluid stall_banner_left_two">
                                <img :src="adds.ads_position == 2?adds.image:''" class="img-fluid stall_company_logo">

                                 <iframe class="iframedesign" :src="adds.ads_position == 1?adds.video_link +'?autoplay=1&controls=0&mute=1':'' " frameborder="0" allow="autoplay; accelerometer;  clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                            </p>


                          <div class="stalllayout_img_div">
                            <img :src="this.imageUrl+'stall.jpeg'" alt="Stall-Layout" class="img-fluid stall_layout_img">
                            <img :src="this.imageUrl+'wlogo.png'" alt="Stall-Layout" class="img-fluid stall_company_name">
                            <!-- <img :src="this.imageUrl+'wlogo.png'" alt="Stall-Layout" class="img-fluid stall_company_logo"> -->
                            <!-- <iframe class="iframedesign" :src="adds.video_link" frameborder="0" allow="autoplay; accelerometer;  clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe> -->
                            <!-- <img :src="adds.ads_position == 3?adds.image:''" alt="Stall-Layout" class="img-fluid stall_banner_right"> -->
                            <!-- <img :src="adds.ads_position == 4?adds.image:''" alt="Stall-Layout" class="img-fluid stall_banner_right_two"> -->

                            <!-- <img :src="adds.ads_position == 5?adds.image:''" alt="Stall-Layout" class="img-fluid stall_banner_left"> -->
                            <!-- <img :src="adds.ads_position == 6?adds.image:''" alt="Stall-Layout" class="img-fluid stall_banner_left_two"> -->



                            <router-link to = "#" @click.native="openChat" v-if="user.user.role === 'Customer'">
                                    <img :src="imageUrl+'/conversation.png'" alt="Stall-Image" class="img-fluid stall_chatting">
                            </router-link>

                            <router-link to="" v-if="user.user.role === 'Customer'">
                                <img :src="imageUrl+'/video.png'" alt="Stall-Image" class="img-fluid stall_video" @click="makeCall()">
                            </router-link>

                            <router-link to="" v-if="user.user.role === 'Customer'">
                                <img :src="imageUrl+'/mail.png'" alt="Stall-Image" class="img-fluid stall_email">
                            </router-link>

                            <p class="text-light tab_menu_offer"><a href="#tab0">Offer</a></p>
                            <p class="text-light tab_menu_product"><a href="#tab1">Product</a></p>
                            <p class="text-light tab_menu_resource"><a href="#tab2">Resource</a></p>
                            <p class="text-light tab_menu_aboutus"> <a href="#tab3">About Us</a></p>


                        </div>

                        </div>
                    </div>
                 <stall-chatting id="chatting_bot" v-if="isChatting" :closeChat="closeChat" :sendMessage="sendMessage" :send_message="send_message" :receive_message="receive_message"></stall-chatting>
                </div>
            </section>


         <!-- <section id="shopdetails_part">

            <LazyVideo style="width:100%; position:relative;" :src="url+'exibitionhall.mp4'" :poster="url+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>
            <div class="stall_bar">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="stall_subdiv">
                        <router-link to="/stall-details">
                                    <img :src="url+'/stall.PNG'" alt="Stall-Image" class="img-fluid stalldetails_image_stall">
                        </router-link>

                            <router-link to = "/stall-chatting">
                                    <h4 class="title_calling">Chatting</h4>
                                <img :src="url+'/conversation.png'" alt="Stall-Image" class="img-fluid stall_calling">
                            </router-link>

                            <router-link to="">
                                <img :src="url+'/video.png'" alt="Stall-Image" class="img-fluid stall_calling" @click="makeCall()">
                            </router-link>


                    </div>

                    <p class="tab_menu_offer">Offer</p>
                    <p class="tab_menu_product">Product</p>
                    <p class="tab_menu_resource">Resource</p>
                    <p class="tab_menu_aboutus">About Us</p>

                </div>
            </section>



        <div class="container pl-0" style="margin-bottom: 20%;">
            <div class="row">
                <div class="col-md-12 text-right pl-0">
                    <div class="bg-orange cvbank-tablist-main mb-3">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">



                            <li :class="['nav-item  stall-tab',{active:currentTab.name === tab.name}]" v-for="(tab, tabindex) in tabs" :key="tabindex"
                                @click.prevent="currentTab = tab" :id="'tab'+tabindex">
                                <a href=""  class="menu-tab-button"  >{{ tab.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->
            <!--Login Component goes here-->
            <keep-alive>
                <component :is="currentTab.component" class="tab"></component>
            </keep-alive>
        </div>

</template>

<script>
import { mapGetters } from 'vuex'
import Products from "../stall/stall-tabs/Products";
import Resource from "../stall/stall-tabs/Resource";
import AboutUs from "../stall/stall-tabs/AboutUs";
import Offer from "../stall/stall-tabs/Offer";
import VideoLazy from 'vue-lazyload-video'
import StallChatting from '../helpdesk/StallChatting'

let tabs = [
    {
        name:'Product',
        component:Products
    },
    {
        name:'Offer',
        component:Offer
    },
    {
        name:'Resource',
        component: Resource
    },
    {
        name:'About Us',
        component: AboutUs
    }
]
export default {

    data(){
        return {
            url:window.location.origin,
            imageUrl:window.location.origin,
            image:'',
            stalls: {},
            tabs,
            currentTab: tabs[0],
            isChatting:false,
            send_message:[{message:''}],
            receive_message:[{chat_receive:''}],
            stallads: {},

        }
    },
  created(){
    this.imageUrl = this.imageUrl+'/frontend/assets/home-images/'

    let stall_id = this.$route.params.stall_id

    setTimeout(() => {
        axios.get(this.url+'/api/frontend-stall-details?stall_id='+stall_id)
        .then(res => {
            // console.log(res.data);
        })
    }, 1000)

    setTimeout(() => {
        axios(this.url+'/api/showads-stall').then(response=>{
            this.stallads = response.data.data;
            console.log('ShowAds',this.stallads)
        })
    }, 1000)

    this.updateScroll()


    messaging.onMessage((payload)=>{

        console.log('incoming Data on message', payload.data);

        if(payload.data.call_state == 3){
            let chat_information= localStorage.getItem('chatInfo')
            if(!chat_information || chat_information == null || chat_information == ""){
                localStorage.setItem('chatInfo', payload.data.customer_id)
            }

            this.isChatting = true

            this.receive_message.push({chat_receive: payload.data.chat_message, chat_time:payload.data.chat_time, company_user_name:payload.data.company_user_name, company_user_photo:payload.data.company_user_photo})

        }

        // else if(payload.data.call_state == 1 && payload.data.call_status != 'received'){
        //     let receive_call_url = window.location.origin+'/receive-call';
        //     let incoming_call = window.open(
        //     receive_call_url,
        //     "DescriptiveWindowName",
        //     "resizable,scrollbars,status",
        //     );
        //     incoming_call.window.customer_id        = payload.data.customer_id
        //     incoming_call.window.company_id         = payload.data.company_id
        //     incoming_call.window.customer_name      = payload.data.customer_name
        //     incoming_call.window.customer_photo     = payload.data.customer_photo
        //     incoming_call.window.company_user_name  = payload.data.company_user_name
        //     incoming_call.window.roomId             = payload.data.roomId
        //     incoming_call.window.company_user_token = payload.data.company_user_token


        // }
    });

  },
  computed:{
    ...mapGetters({
        user:'user'
    })
  },

  methods: {
      sendMessage(event){
          console.log(event.target.value);
          let chat_message = event.target.value

        //   window.scrollTo(0,document.querySelector("#chat").scrollHeight);
          var container = this.$el.querySelector("#chat");
            container.scrollTop = container.scrollHeight - container.clientHeight;
            console.log('SCROLL',container.scrollHeight);


            var sentData = ''

            let customer_id = localStorage.getItem('chatInfo')

            if(this.user.user.role == 'Customer'){
                sentData = {

                company_id:this.$route.params.company_id,
                chat_message:chat_message

                }

            }

            if(this.user.user.role == 'Company' || this.user.user.role == 'CustomerCare'){

                sentData = {

                customer_id:customer_id,
                call_state:3,
                chat_message:chat_message

                }
            }

            let apiUrl = this.user.user.role == 'Customer'?this.url+'/api/send-message':this.url+'/api/receive-message'

            axios.post(apiUrl, sentData)
            .then(res => {
                console.log(res.data);

                 this.send_message.push({message:res.data.chat_message, customer_name:res.data.customer_name,chat_time:res.data.chat_time, customer_photo:res.data.customer_photo})
                event.target.value = ''
            })
      },
      openChat(){
          this.isChatting =true
      },

      closeChat(){
          this.isChatting = false
      },

      updateScroll(){
                // var element = document.getElementById("chatting_bot");
                // element.scrollTop = element.scrollHeight;
                jQuery('#chatting_bot').animate({scrollTop:0},0);
            },
      makeCall(){
        let customer_token = localStorage.getItem('web_token')
        let  data = {
            callState:1,
            stall_id:this.$route.params.stall_id,
            company_id:this.$route.params.company_id
        }

        let make_call_url = this.url+'/make-call'

        axios.post(this.url+'/api/make-call', data)
        .then(res => {

            if(res){
                console.log(res.data);
                let calling = window.open(
                make_call_url,
                "DescriptiveWindowName",
                "resizable,scrollbars,status",
                )

                calling.window.company_user_name  = res.data.company_user_name
                calling.window.company_user_photo = res.data.company_user_photo
                calling.window.customer_name      = res.data.customer_name
                calling.window.customer_photo     = res.data.customer_photo
                calling.window.company_id         = res.data.company_id
                calling.window.roomId             = res.data.roomId
                calling.window.company_user_token = res.data.company_user_token

            }

        })



      }
  },
    components: {
        VideoLazy,
        StallChatting
    },

}
</script>

<style scoped>

.stall_company_name {
	position: absolute;
	left: 50.2%;
	top: 4%;
	transform: translateX(-50%);
	width: 16% !important;
}
.stall_company_logo {
	position: absolute;
	left: 69%;
	top: 63%;
	transform: translateX(-50%);
	width: 9% !important;
    z-index: 9999;
}

.iframedesign {
	position: absolute;
	left: 39%;
	right: 0;
	height: 31%;
	top: 21%;
	width: 21.5%;
    z-index: 9999;
}

.stall_banner_left {
	position: absolute;
	left: 5%;
	top: 36%;
	width: 8.8%;
	height: 46%;
	rotate: -2deg;
    z-index: 9999;
}

.stall_banner_left_two {
	position: absolute;
	left: 15%;
	top: 21%;
	width: 9.4%;
	height: 57%;
    z-index: 9999;
}

.stall_banner_right {
	position: absolute;
	right: 4%;
	top: 36%;
	width: 9%;
	height: 40%;
	rotate: 1deg;
    z-index: 9999;
}

.stall_banner_right_two {
	position: absolute;
	right: 14%;
	top: 22%;
	width: 9%;
	height: 52%;
	rotate: 1deg;
    z-index: 9999;
}




.stalldetails_image_stall {
    width: 100%;
    height: 850px !important;
}

li.nav-item.stall-tab.active{
    background: #6abd47 !important;
}
li.nav-item.stall-tab .active a{
    color: white !important;
}
li.nav-item.stall-tab {
    padding: .8% 5%;
}
li.nav-item.stall-tab a{
    color: black !important;
}
li.nav-item.stall-tab a:hover {
    text-decoration: none;
}
ul#pills-tab {
    margin: 3% 5px;
    border-bottom: 1px solid #e6e6e6;
}
</style>
