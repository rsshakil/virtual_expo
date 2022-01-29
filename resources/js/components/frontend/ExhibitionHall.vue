<template>
   <div>
    <!-- Lobby Part Start -->
    <section id="exhibition_part">
        <div class="row">
            <div class="col-lg-12">

                <LazyVideo style="width:100%; position:relative;" :src="fileUrl+'exibitionhall.mp4'" :poster="fileUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

                        <div class="header_ads_one" v-for="(adds, index) in exhibitionAds" :key="index">
                            <div class="header_ads_body">
                               <ul class="ads_ul">

                                    <li class="ads_left_li">
                                        <img :src="fileUrl+'02.png'" alt="" class="img-fluid banner_ads_image_left">
                                        <iframe class="iframe_left" :src="adds.ads_position == 9?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>

                                     <li class="ads_center_li">
                                        <img :src="fileUrl+'02.png'" alt="ads_banner" class="img-fluid banner_ads_image_middle">
                                        <iframe class="iframe_middle" :src="adds.ads_position == 7?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                    </li>

                                    <li class="ads_right_li">
                                        <img :src="fileUrl+'02.png'" alt="" class="img-fluid banner_ads_image_right">
                                        <iframe class="iframe_right" :src="adds.ads_position == 8?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                                        <!-- Walton ads -->
                                     </li>

                                 </ul>
                            </div>
                        </div>

                        <div class="lobby_setup">
                            <div class="lobby">
                                <ul v-for="(category, index) in eventCategories" :key="index">
                                     <li v-if="index == 0">
                                        <router-link class="lobby_one" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                            {{ category.event_sub_category_name }}
                                        </router-link>
                                     </li>

                                     <li v-if="index == 1">
                                         <router-link class="lobby_two" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                            {{ category.event_sub_category_name }}
                                         </router-link>
                                     </li>
                                     <li v-if="index == 2">
                                         <router-link class="lobby_three" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                            {{ category.event_sub_category_name }}
                                        </router-link>
                                     </li>
                                     <li v-if="index == 3">
                                         <router-link class="lobby_four" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                           {{ category.event_sub_category_name }}
                                        </router-link>
                                     </li>
                                     <li v-if="index == 4">
                                         <router-link class="lobby_five" :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()">
                                            {{ category.event_sub_category_name }}
                                         </router-link>
                                     </li>
                                </ul>
                            </div>
                        </div>

                        <div class="footer_ads_left_li" v-for="(adds, index) in exhibitionAds" :key="index">
                            <img :src="fileUrl+'bottomleft.png'" alt="ads_banner" class="img-fluid footer_ads_one">
                            <iframe class="iframe_footer_ads" :src="adds.ads_position == 10?adds.video_link:''" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                        </div>

                        <div class="footer_ads_right_li" v-for="(adds, index) in exhibitionAds" :key="index">
                            <img :src="fileUrl+'bottomright.png'" alt="ads_banner" class="img-fluid footer_ads_two">

                            <iframe class="iframe_footer_right" :src="adds.ads_position == 11?adds.video_link:''"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                        </div>


            </div>
        </div>
    </section>
   <!-- Lobby Part Start -->
   </div>
</template>

<script>
import VideoLazy from 'vue-lazyload-video'

export default {

    data(){
        return {
            url:window.location.origin,
            fileUrl:'',
            exhibitionAds: {},
            eventCategories:[]
        }

    },
    created() {
        // this.getStallAds()
        this.fileUrl = this.url+'/frontend/assets/home-images/'

        axios.get(this.url+'/api/frontend-event-sub-category')
        .then(res => {
            this.eventCategories = res.data.data
            // console.log('event sub cat', res);
        })

        setTimeout(()=>{

             axios(this.url+'/api/exhibition-ads').then(response=>{
                this.exhibitionAds = response.data.data;
                // console.log('ads', this.exhibitionAds)
            })

        }, 1000)



    },
     components: {
         VideoLazy
     },

    methods:{

    },

}
</script>

<style scoped>


</style>
