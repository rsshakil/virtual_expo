<template>
  <div>

    <!-- Footer Part Start -->
    <section id="footer_part">
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-light bg-dark">
        <!-- <div class="col-md-2 order-2 order-md-1 sm_class">
            <button class="btn_success">Exhibitor</button>
        </div> -->
        <div class="col-lg-12">

                <carousel :autoplay="true" :nav="false" :dots="false" :loop="true" :autoplaySpeed="3000" :autoplayTimeout = "3000" :responsive="{0:{items:1,nav:false},600:{items:2},900:{items:4},1200:{items:5}}">
                    <!-- :autoplaySpeed="1000" -->

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                     <img :src="imageUrl+'wlogo.png'" alt="wlogo" class="img-fluid btn_gray img_footer">
                    </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                        <img :src="imageUrl+'2.jpeg'" alt="wlogo" class="img-fluid btn_gray">
                    </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="imageUrl+'3.jpeg'" alt="wlogo" class="img-fluid btn_gray">
                    </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                        <img :src="imageUrl+'4.jpeg'" alt="wlogo" class="img-fluid btn_gray">
                    </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <img :src="imageUrl+'5.jpeg'" alt="wlogo" class="img-fluid btn_gray">
                    </div>

                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12 col-12">
                        <img :src="imageUrl+'6.jpeg'" alt="wlogo" class="img-fluid btn_gray">
                    </div>

                </carousel>

        </div>


        </nav>

    </section>
    <!-- Footer Part Start -->
  </div>
</template>

<script>

import carousel from 'vue-owl-carousel'

export default {
    components: { carousel },
    data(){
    return {
        imageUrl:window.location.origin,
        image:''
    }
    },
    created(){
        this.imageUrl = this.imageUrl+'/frontend/assets/footer-slider/'
    }
}

</script>

<style scoped>

.owl-carousel .owl-item img {
    display: block;
    width: 80%!important;
}

.btn_gray {
    background: #f8f8f8;
    border-radius: 5px;
    margin-top: 2%;
    height: 45px;
}
</style>
