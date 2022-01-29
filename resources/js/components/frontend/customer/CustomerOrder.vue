<template>
    <div>
        <div class="container mt-5">
          <div class="row">
              <div class="col-md-12 mb-3">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="text-center mb-0">Order Page</h3>
                      </div>
                  </div>
              </div>
            <div class="col-lg-4">
              <div class="card h-100">
                  <div class="card-body">
                      <div class="profile_image">
                          <img :src="this.imgUrl+'/person.png'" alt="stall-image" class="img-fluid profile_image">
                      </div>
                      <div class="profile_body">
                          <p class="text-left ml-3"><strong> Name :  {{user.name}} </strong></p>
                          <p class="text-left ml-3"><strong>Email :   {{user.email}} </strong></p>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100" style="margin-bottom:100px">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL No.</th>
                                <th>Order Number</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>

                            <!-- v-for start -->
                            <tr v-for="(order, index) in orders" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{order.order_number}}</td>
                                <td>{{order.quantity}}</td>
                                <td>{{order.created_at}}</td>
                                <td>৳ {{order.amount}}</td>
                                <td>
                                    <router-link :to="{name:'CustomerOrderDetails', params:{id:order.id}}"  class="btn btn-success btn-sm fa fa-eye" ></router-link>
                                    <router-link :to="{name:'CustomerInvoice', params:{id:order.invoice.id}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Invoice</router-link>
                                </td>
                            </tr>
                            <!-- v-for end -->
                        </table>
                    </div>
                </div>
            </div>
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
            apiUrl : window.location.origin,
            carts:[],
            summary:[],
            imgUrl : window.location.origin,
            orders:[],
            user:[],
            serial:0,
        }
    },

     created(){
        this.imgUrl = this.imgUrl+'/frontend/assets/home-images/'
        this.getOrders()
    },
    methods:{
        getOrders(){
            axios.get(this.apiUrl+'/api/order').then(response =>{
               this.orders  =response.data.data
               this.user    = response.data.user
            })
        }
    }

}
</script>

<style scoped>
.profile_maindiv {
  margin-top: 15%;
  border: 1px solid #ecdddd;
  text-align: center;
  padding-bottom: 30px;
  border-radius: 10px;
}

.profile_image {
  border-radius: 50%;
}

</style>
