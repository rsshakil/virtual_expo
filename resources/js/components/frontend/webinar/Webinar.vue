<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
               <p class="mt-2">Exhibition Hall > Webinar</p>
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="bg-orange cvbank-tablist-main mb-3">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item date-nav" v-for="tab in tabs" :key="tab.name"
                                    @click.prevent="currentTab = tab">
                                    <a href=""  :class="['btn btn-sm',{active:currentTab.name === tab.name}]"  >{{ tab.name }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--                        Login Component goes here-->
                <keep-alive>
                    <component :is="currentTab.component" class="tab"></component>
                </keep-alive>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import TabOne from "./webinar-tabs/TabOne";
let tabs = [
    {
        name:'Thus Jan 11',
        component:'TabOne'
    },
    {
        name:'Fri Jan 12',
        // component: 'TabTwo'
    },
    {
        name:'Sat Jan 13',
        // component: 'TabThree'
    },
    {
        name:'Sun Jan 14',
        // component: 'TabFour'
    },
]

export default {
    data(){
        return {
            tabs,
            currentTab: tabs[0],
            imageUrl : window.location.origin,
        }
    },
    components:{
        'TabOne': TabOne,
        // 'TabTwo': TabTwo,
        // 'TabThree': TabThree,

    },
    created() {
        this.imageUrl = this.imageUrl+'/frontend/assets/webinar/'
    },
    computed:{
        ...mapGetters({
            user:'user'
        })
    }
}
</script>

<style scoped>
.cvbank-tablist-main .nav-item .active {
    color: green !important;
    border-bottom: 1px solid green !important;
    background: transparent;
}

a.btn{
    color:black !important;
}
.btn.focus, .btn:focus{
    box-shadow: none;
}
ul#pills-tab {
    border-bottom: 1px solid silver;
}
li.nav-item.date-nav:first-child {
    padding: 0;
}
li.nav-item.date-nav {
    padding: 0 20px;
}
.webinar-title {
    color: green;
}
.btn-success {
    background-color: #6ABD48 !important;
    border-color: #6ABD48 !important;
}
.speaker-photo {
    border-radius: 50%;
    border: 1px solid silver;
}
.speaker-details p{
    margin: 0;
}
.card{
    border: none;
    background-color: #ededed;
}
.cart-container{
    border-left: 2px solid green;
}
.timeline-dots {
    position: absolute;
    left: -5%;
    top: 5px;
}
</style>
