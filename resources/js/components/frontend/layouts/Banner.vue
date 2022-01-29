<template>
   <div>
    <!-- Banner Part Start -->
    <section id="banner_part">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">

                    <LazyVideo id="autoplay_on" style="width:100%; z-index:-1; position:relative; margin-top:-6%;" :src="imageUrl+'homepage.mp4'" :poster="imageUrl+'banner.png'" :attrs="{controls: false, playsinline: true, loop: false, autoplay: true, muted: true}"/>

                    <div class="header_ads_one">
                        <div class="header_ads_body">
                            <ul class="ads_ul">

                                    <li class="ads_center_li">
                                    <img v-if="showElement" :src="imageUrl+'homebanner.png'" alt="ads_banner" class="banner_ads_image">
                                    <iframe v-if="showElement"  class="iframe" src="https://www.youtube.com/embed/h7wWNIlYC7c?autoplay=1&controls=0&mute=1" frameborder="0" allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                </li>
                                </ul>
                        </div>
                    </div>

                        <router-link v-if="showElement" to="lobby" class="btn btn-success text-center mt-5 btn_success">Click to Enter the Lobby</router-link>

                </div>
            </div>
        </section>
   <!-- Banner Part Start -->
   </div>
</template>

<script>
import VideoLazy from 'vue-lazyload-video'
import carousel from 'vue-owl-carousel'

export default {

    data(){
        return {
            url:window.location.origin,
            stallads: {},
            showElement:false
        }

    },

     components: {
         VideoLazy,
         carousel
     },

    created(){
        this.imageUrl = this.url+'/frontend/assets/home-images/'
         this.getStallAds()

    },
    mounted(){
        setTimeout(()=>{
            this.showElement = true
        }, 10000)

        // setTimeout(() => {
        //     // document.getElementById('autoplay_on').play();
        // }, 1000)
        // document.getElementById('autoplay_on').play();
    },
     methods:{
        getStallAds()
        {
            axios(window.location.origin+'/api/stall-ads').then(response=>{
                this.stallads = response.data.data;
                console.log(response.data.data)
            })
        },
    },

}

</script>

<style scoped>


</style>>
