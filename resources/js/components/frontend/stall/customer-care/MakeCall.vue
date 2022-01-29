<template>
  <div>

      <section id="videocall_part" v-if="isCalling">

            <div class="row text-center justify-content-center">

                <div class="col-md-4 signupfull_div">

                    <div class="video_header">

                        <img :src="imageUrl+company_user_photo" alt="Stall-Image" class="img-fluid callrecevie_image">
                        <!-- <i class="fab fa-whatsapp call_icon"></i> -->

                        <h4 class="call_name">{{ company_user_name }}</h4>
                        <span class="call_span mt-2">Ringing...</span>
                    </div>

                    <div class="video_body">
                        <ul>
                            <!-- <li>
                                <i class="fas fa-phone-slash text-light text-left icon"></i>
                            </li> -->

                             <li class="li_middle">
                                <router-link to="#" @click.native="cancelOutGoingCall()">
                                    <i class="fas fa-phone-alt text-light text-center iconone"></i>
                                </router-link>
                            </li>

                            <!-- <li>
                                <router-link @click="receiveCall()"><i class="fas fa-comment-alt text-light text-right icontwo"></i></router-link>
                            </li> -->
                        </ul>

                        <p>Swipe up to accept</p>

                    </div>
                </div>
            </div>
            <audio autoplay loop>
            <source :src="soundUrl+'/outgoing-ring.mp3'" type="audio/ogg">
            <source :src="soundUrl+'/outgoing-ring.mp3'" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
      </section>

      <vue-jitsi-meet v-if="isCalling == false"
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
          company_user_name:'',
          company_user_photo:'',
          customer_name:'',
          roomId:'',
          company_id:'',
          isCalling:true,
          company_user_token:''
        }
    },

components: {
    VueJitsiMeet: JitsiMeet
  },

  created(){

       this.company_user_name  = window.company_user_name
       this.company_user_photo = window.company_user_photo
       this.customer_name      = window.customer_name
       this.company_id         = window.company_id
       this.roomId             = window.roomId
       this.company_user_token = window.company_user_token
       this.imageUrl = this.url+'/images/user/'

       console.log('companyid', window.company_id);

        messaging.onMessage((payload)=>{

        console.log('received call message', payload.data);

        let join_call = this.url+'/join-call';

        if(payload.data.call_state == 1 && payload.data.call_status == 'received'){
           this.isCalling = false
          //  $('#videocall_part').remove()
        }

        if(payload.data.call_state == 2){
            let make_call_window = this.url+'/make-call'
            window.close(make_call_window)
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
          displayName: this.customer_name,
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
      cancelOutGoingCall(){

          let data = {
              call_state:2,
              company_id:this.company_id,
              company_user_token:this.company_user_token
          }
          axios.post(this.url+'/api/cancel-outgoing-call', data)
          .then(res => {

              if(res){
                    let cancel_call_url = this.url+'/make-call'
                    window.close(cancel_call_url)
              }
          })

      },
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
}

.iconone {
	background-color: red;
	padding: 17px 15px;
	line-height: 20px;
	font-size: 25px;
	border-radius: 50%;
	margin-left: 50%;
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
