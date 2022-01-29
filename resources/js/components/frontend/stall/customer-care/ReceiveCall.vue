<template>
  <div>

      <section id="videocall_part" v-if="isReceived == false">

            <div class="row text-center justify-content-center">

                <div class="col-md-4 signupfull_div">

                    <div class="video_header">

                        <img :src="url+'/'+customer_photo" alt="Stall-Image" class="img-fluid callrecevie_image">
                        <!-- <i class="fab fa-whatsapp call_icon"></i> -->

                        <h4 class="call_name">{{ customer_name }}</h4>
                        <span class="call_span mt-2">Incomming ...</span>
                    </div>

                    <div class="video_body">
                        <ul>
                            <li>
                                <router-link  to="#" @click.native="cancelIncomingCall()">
                                        <i class="fas fa-phone-slash text-light text-left icon" ></i>
                                </router-link>
                            </li>

                            <li class="li_middle">
                                <router-link to="#" @click.native="receiveCall()">
                                    <i class="fas fa-phone-alt text-light text-center iconone"></i>
                                </router-link>
                            </li>

                            <!-- <li>
                                <i class="fas fa-comment-alt text-light text-right icontwo"></i>
                            </li> -->
                        </ul>

                        <p>Swipe up to accept</p>

                    </div>
                </div>
            </div>

            <audio autoplay loop>
            <source :src="soundUrl+'/incoming-ring.mp3'" type="audio/ogg">
            <source :src="soundUrl+'/incoming-ring.mp3'" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
      </section>

       <vue-jitsi-meet v-if="isReceived == true"
      ref="jitsiRef"
      domain="meet.jit.si"
      :options="jitsiOptions"
    ></vue-jitsi-meet>
  </div>
</template>

<script>

import { JitsiMeet } from '@mycure/vue-jitsi-meet';
import mixin from '../../../../src/mixin-frontend'

export default {
    mixins:[mixin],
     data(){
        return {
          url:window.location.origin,
          imageUrl:'',
          customer_name:'',
          customer_photo:'',
          company_user_name:'',
          customer_id:'',
          roomId:'',
          isReceived:false

        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  created(){
    this.customer_name     = window.customer_name
    this.customer_photo    = window.customer_photo
    this.customer_id       = window.customer_id
    this.roomId            = window.roomId
    this.company_user_name = window.company_user_name
    this.imageUrl = this.url+'/images/user/'

    messaging.onMessage((payload)=>{

        console.log('received message from incoming', payload.data);

        if(payload.data.call_state == 2){
            let receive_call_window = this.url+'/receive-call'
            window.close(receive_call_window)
        }
    });

  },
     computed: {


    jitsiOptions () {
      return {
        roomName: this.roomId,
         width:window.innerWidth,
        height:window.innerHeight,
        noSSL: false,
        userInfo: {
          email: 'user@email.com',
          displayName: this.company_user_name,
        },
        configOverwrite: {
          prejoinPageEnabled: false,
          enableNoisyMicDetection: false
        },
        interfaceConfigOverwrite: {
          SHOW_JITSI_WATERMARK: false,
          SHOW_WATERMARK_FOR_GUESTS: false,
          SHOW_CHROME_EXTENSION_BANNER: false
        },
        onload: this.onIFrameLoad
      };
    },
  },
  methods:{

    onIFrameLoad () {
      // do stuff
    },

      receiveCall(){

        let data = {
            customer_id:this.customer_id,
            call_state:1
        }

        axios.post(this.url+'/api/receive-call', data)
        .then(res => {

           if(res){

               this.isReceived = true
              //  $('#videocall_part').remove()

           }

        })
      },

      cancelIncomingCall(){
          let data = {
            customer_id:window.customer_id,
            call_state:2
        }


         axios.post(this.url+'/api/cancel-incoming-call', data)
         .then(res => {

             let receive_call = this.url+'/receive-call'
             window.close(receive_call)

         })


      }
  }
}
</script>

<style scoped>
.video_header {
	background-color: #00796A;
	position: relative;
	padding-bottom: 5%;
}
.callrecevie_image {
        width: 20%;
        height: 20%;
        border-radius: 50%;
        margin-bottom: 5%;
        margin-top: 4%;
}

.call_icon {
	position: absolute;
	left: 56%;
	top: 50%;
	transform: translateX(-50%);
	color: #fff;
	background-color: #65e165;
}

.call_name {
    font-size: 22px;
    color: #fff;
}
.call_span {
    text-transform: uppercase;
    color: #fff;
}
.video_body ul {
    list-style: none;
    display: flex;
}
.video_body ul li .a_class {
    color: #fff;
}

.video_body p {
    color: #fff;
}

.li_middle {
	padding: 0px 30%;
	margin-bottom: 3%;
}

.icon {
	background: rgba(22, 21, 21, 0.5);
	padding: 17px 15px;
	line-height: 20px;
	font-size: 25px;
	border-radius: 50%;
    margin-left: 50%;
    z-index: 9999;
}

.iconone {
	background-color: green;
	padding: 17px 15px;
	line-height: 20px;
	font-size: 25px;
	border-radius: 50%;
    margin-left: 50%;
    z-index: 9999;
}

.icontwo {
	background: rgba(22, 21, 21, 0.5);
	padding: 17px 15px;
	line-height: 20px;
	font-size: 25px;
	border-radius: 50%;
	margin-left: 50%;
}

</style>
