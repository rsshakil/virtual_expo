<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 my-5" v-if="order.order_number!=null">
                <h3>Order Page</h3>
                <h3 class="text-center mt-5 text-success">Your order placed Successfully!</h3>
                <h5 class="text-center">Order Number: <strong>{{order.order_number}}</strong> </h5>
            </div>
            <div class="col-md-12 my-5 " v-else>
                <h3 class="text-danger text-center">No Order Found</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {

  data(){
        return {
            url:window.location.origin,
            image:'',
            order: {},
            apiUrl : window.location.origin,
        }
    },
      created(){
        this.url = this.url+'/frontend/assets/home-images/'
         this.getOrderNumber()
      },
    methods:{
        getOrderNumber()
        {
            axios.get(this.apiUrl+'/api/get-order-number/').then(res=>{
                this.order =  res.data
                console.log(this.order)
            })
        },
    }

}
</script>

<style scoped>

.title {
  border-bottom: 2px solid #F1F1F1;
  margin: 0 30px;
  padding-bottom: 10px;
}
.cart_list ul {
  list-style: none;
}
.cart_list ul li {
  padding: 10px 30px;
}

.cart_list .li_span_right {
  float: right;
}

.left_side {
  border: 2px solid #F1F1F1;
}

.cart_image {
  background-color: #F1F1F1;
  text-align: center;
  padding: 10px 5px;
}

.product_name {
	font-size: 18px;
  font-weight: 500;
  line-height: 26px;
}

.offer_price {
	font-size: 22px;
	font-weight: 600;
}

.selling_price {
  text-decoration: line-through;
  color: red;
  font-size: 16px;
}
.total_price {
	font-size: 22px;
	font-weight: 600;
	text-align: right;
	padding-right: 5%;
	color: #6ABD48;
}

.delete_icon {
	cursor: pointer;
	padding: 8px 11px;
	background-color: red;
	border-radius: 50%;
	color: #fff;
	margin-top: 3%;
	float: right;
	margin-right: 10%;
}

</style>
