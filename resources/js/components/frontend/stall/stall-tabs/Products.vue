<template>
    <div>
        <div class="row">

            <div class="col-4 mb-3" v-for="product in products" :key="product.id">
                <div class="card single-product-area">


                    <router-link :to="'/single-product/'+company_id+'/'+stall_id+'/'+product.id">
                        <img :src="imageUrl+product.image[0].image" alt="Live Recording" class="img-fluid product-photo">
                    </router-link>

                    <span class="discount-offer">10% OFF</span>
                    <h5 class="text-center">{{product.product_name}}</h5>
                    <div class="row">
                        <div class="col-8 text-center">
                            <p class="price">৳ <span v-if="product.offer_price">{{product.offer_price}}</span> <span v-else>{{product.selling_price}}</span>  <small v-if="product.offer_price" class="discount-price pl-3">৳
                                {{product.selling_price}}</small></p>
                        </div>
                        <div class="col-4 text-center">
                            <span class="fa fa-star checked"></span> 5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Products",
    data(){
        return{
            url: window.location.origin,
            products:[],
            imageUrl:'',
            stall_id:'',
            company_id:'',

        }
    },
    methods:{
        getProducts()
        {
            axios(this.url+'/api/products').then(response=>{
                this.products = response.data.data;
                console.log('product', response.data.data)
            })
        },
    },

    created() {
        this.imageUrl = this.url+'/frontend/assets/product-images/'
        this.getProducts()
    },
    mounted(){
        let company_id = this.$route.params.company_id
        let stall_id = this.$route.params.stall_id

        this.company_id = company_id
        this.stall_id = stall_id
        console.log('company_id', company_id);
        console.log('stall_id', stall_id);
    }
}
</script>

<style scoped>
.price{
    color: #6abd47 !important;
}
.discount-price{
    color: red !important;
    text-decoration: line-through;
}
.price-area{
    display: flex;
    justify-content: center;
}
.card.single-product-area {
    border: 1px solid #f1f0f0;
    box-shadow: 0 0 2px silver;
    padding: 15px;
}
.fa-star.checked{
    color: gold;
}
.discount-offer {
    position: absolute;
    background: red;
    color: white;
    font-size: 12px;
    padding: 2px 5px;
    top: -1px;
    right: -1px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 5px;
    border-right: 1px solid #f1f0f0;
    border-top: 1px solid #f1f0f0;
}
</style>
