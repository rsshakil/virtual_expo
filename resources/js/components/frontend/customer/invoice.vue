<template>
   <div class="container" style="margin-bottom: 100px">
       <div class="row justify-content-center">
           <div class="col-8">
               <div class="card mt-5">
                   <div class="card-header">
                       <span class="back_arrow" @click="$router.go(-1)"><h3><i class="fas fa-arrow-left"></i></h3></span>    <h3 class="text-center mb-0">Invoice No# {{invoice.invoice_number}}</h3>
                   </div>
                   <div class="card-body p-5">
                       <div class="logo-area mb-3 p-2" style="background: silver">
                             <h3 class="mb-0"><img :src="logoUrl" class="img-responsive img-fluid" alt="Logo" width="75px"> Digital DITF 2021</h3>
                       </div>
                       <div class="row">
                           <div class="col-6">
                               <h4>From</h4>
                               <h6><strong>Digital DITF 2021</strong></h6>
                               <p class="mb-0">Dhaka, 1200</p>
                               <p class="mb-0">01719123886</p>
                               <p class="mb-0">sales@ditf.com</p>
                           </div>
                           <div class="col-6 text-right">
                               <h4>To</h4>
                               <h6><strong>{{invoice.user.name}}</strong></h6>
                               <p class="mb-0">{{invoice.user.email}}</p>
                               <p class="mb-0">{{invoice.order.shipping.phone}}</p>
                               <p class="mb-0">{{invoice.order.shipping.address}}</p>
                               <p class="mb-0">{{invoice.order.shipping.area}}</p>
                               <p>{{invoice.order.shipping.thana}}, {{invoice.order.shipping.district}} - {{invoice.order.shipping.post_code}}</p>
                           </div>
                       </div>
                       <table class="table table-bordered">
                           <tr style="background: silver">
                               <th>SL</th>
                               <th>Description</th>
                               <th>Unit Price</th>
                               <th>Quantity</th>
                               <th>Amount</th>
                           </tr>
                           <tr  v-for="(product, index) in invoice.order.order_details" :key="index">
                               <td>{{index+1}}</td>
                               <td>{{product.product_name}}</td>
                               <td>{{product.price}} Tk.</td>
                               <td>{{product.quantity}}</td>
                               <td>{{product.price * product.quantity}} Tk.</td>
                           </tr>
                           <tr border="none">
                               <td colspan="3" style="border: none!important;"></td>
                               <th>Quantity</th>
                               <th style="background: silver">{{ invoice.order.quantity }}</th>
                           </tr>
                           <tr>
                               <td colspan="3" style="border: none!important;"></td>
                               <th>Shipping Charge</th>
                               <th style="background: silver">150 Tk.</th>
                           </tr>
                           <tr>
                               <td colspan="3" style="border: none!important;"></td>
                               <th>Grand Total</th>
                               <th style="background: silver">{{invoice.order.amount}} Tk.</th>
                           </tr>
                       </table>
                       <p>Thank you for shopping with us</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
export default {
    name: "invoice",
    data(){
        return{
            logoUrl: window.location.origin+'/frontend/assets/home-images/logo.png',
            invoice : [],
            url: window.location.origin,
        }
    },
    created() {
        this.getInvoice()
    },
    methods: {
        getInvoice() {
            axios.get(this.url+'/api/invoice/'+this.$route.params.id).then(response =>{
                this.invoice= response.data
            })
        }
    }
}
</script>

<style scoped>
.back_arrow {
    position: absolute;
}
.back_arrow:hover{
    text-decoration: none;
    color: darkcyan;
    cursor: pointer;
}
</style>
