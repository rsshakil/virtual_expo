<template>
  <div>

     <!-- Lobby Part Start -->
    <section id="shoppage_part">
            <LazyVideo style="width:100%; position:relative;" :src="imageUrl+'exibitionhall.mp4'" :poster="imageUrl+'exibitionhall.png'" :attrs="{controls: false, playsinline: true, loop: true, autoplay: true, muted: false}"/>

          <div class="row full_stall">

            <strong class="text-light"></strong>

            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
              <div class="shoppage_left mt-5">
                <!-- 'left_a' -->
                <div class="row justify-content-center mt-3">
                      <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                          <input type="text" class="form-control" placeholder="Search Stall" @click="getStalls()">
                      </div>
                </div>

                <ul class="shoppage_left_ul" v-for="(category, index) in eventSubCategories" :key="index">

                  <li v-if="category !==null"><router-link  :to="'/stall-page/'+category.id+'/'+category.event_sub_category_name.replace(/ /g, '-').toLowerCase()" @click.native="getStall(category.id)" :class="routeParams == index+1?'active left_a':'left_a'">{{ category.event_sub_category_name }}</router-link>
                    <ul v-for="(stallItem, sbIndex) in category.stall" :key="sbIndex" v-if="stallItem.event_sub_category_id == category.id">
                      <li><router-link :to="'/stall-details/'+stallItem.company_id+'/'+stallItem.id+'/'+stallItem.stall_name.replace(/ /g, '-').toLowerCase()">{{ stallItem.stall_name }}</router-link></li>
                    </ul>
                  </li>

                </ul>
              </div>
            </div>


            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
              <div class="shoppage_right mt-5 mr-5 mb-5">
                <div class="row text-center">

                  <div class="col-lg-12">
                    <div class="direction_to" style="left:0;right:0;top:0;">
                    <router-link to="/lobby"><i class="fa fa-arrow-left"></i></router-link>
                    <router-link to="/exhibition-hall" :class="this.$route.name == 'ExhibitionHall'?'menu_colored':''">Exhibition Hall</router-link>
                    <router-link to="/stall" :class="this.$route.name == 'Stall'?'menu_colored':''">Stall Page</router-link>
                    <router-link to="/conference-room" :class="this.$route.name == 'ConferenceRoom'?'menu_colored':''">Event Room</router-link>
                    <router-link to="/webinar" :class="this.$route.name == 'Webinar'?'menu_colored':''">Webinar</router-link>
                    <router-link to="/blog-page" :class="this.$route.name == 'BlogPage'?'menu_colored':''">Media Center</router-link>
                    <router-link to="#"><i class="fa fa-arro-right"></i></router-link>
                  </div><br><br>
                      <!-- <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <input type="text" class="form-control" placeholder="Search Stall">
                        </div>
                      </div> -->
                  </div>

                    <div class="col-md-12">
                      <div class="row">

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" v-for="(stall,index) in stalls" :key="index">
                            <div class="shop_maindiv">
                              <div class="shop_subdiv">

                                <router-link :to="'/stall-details/'+stall.company_id+'/'+stall.id+'/'+stall.stall_name.replace(/ /g, '-').toLowerCase()">
                                  <img :src="url+'/frontend/assets/company/'+stall.company_logo" alt="stall-image" class="img-fluid ads_three">
                                  <img :src="url+'/frontend/assets/stall/'+stall.stalllayout" alt="stall-image" class="img-fluid ads_three">
                                </router-link>

                              </div>
                            </div>
                        </div>


                      </div>

                    </div>
                </div>
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
            apiurl:window.location.origin,
            imageUrl:'',
            stalls: {},
            eventSubCategories:[],
            routeParams:this.$route.params.category_id,
            searchStalls: '',
        }
  },

  created(){
    axios.get(this.apiurl+'/api/stall-page?category_id='+this.$route.params.category_id)
      .then(response => {
        this.stalls = response.data.data
        console.log(response.data.data)
    })

    axios.get(this.apiurl+'/api/frontend-event-sub-category-wise-stall')
    .then(res => {
      console.log(res.data.data);
      this.eventSubCategories = res.data.data
    })

    setTimeout(()=>{
      axios(this.url+'/api/search-stalls').then(response=>{
          this.searchStalls = response.data.data;
          console.log('SearchStalls', this.searchStalls)
      })
    }, 1000)





    this.imageUrl = this.url+'/frontend/assets/home-images/'
  },
  methods: {

    getStall(i) {
        axios.get(this.apiurl+'/api/stall-page?category_id='+i)
        .then(response => {
          if(response){
            this.stalls = response.data.data
            console.log(response.data.data)

          }

      })
    }
  },
   components: {
        VideoLazy
    },

}
</script>

<style scoped>
.direction_to {
left: 0;
right: 0;

/* font-size: 49em; */
z-index: 99999999999;
top: 0;
}
.menu_colored{
  color:red !important;

}
.direction_to >a{
  padding: 6px !important;
  margin: 5px;
}
.full_stall {
	position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  top: 8%;
}

.shoppage_left {
	background: rgba(255, 255, 255, 0.8);
	margin-top: 0px;
	position: absolute;
	right: 0;
	top: 0;
	left: 0;
	bottom: 0;
}

.shoppage_left_ul {
  list-style: none;
}

.shoppage_left_ul li {
  padding: 10px 0;
}

.shoppage_left_ul .left_a {
    color:#222;
    text-decoration: none;
    font-size: 22px;
    transition: all linear .5s;
    padding-left: 10%;
    padding-top: 5%;
}

.shoppage_left_ul .left_a:hover {
   color: #E32329;
}

.active {
    color: #E32329 !important;
}

.shop_maindiv {
    background: rgba(255,255,255,.6);
    border-radius: 15px;
    margin-top: 10%;
}

  .shop_subdiv {
    padding: 30px;
}


#footer_part {
	margin-top: -6px !important;
}

#shoppage_part {
  padding-bottom: .9%;
}

</style>
