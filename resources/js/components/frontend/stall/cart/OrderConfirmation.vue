<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center" v-if="Object.keys(carts).length > 0">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 text-center">Shipping Address</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">Choose Address or Add new</h4>
                            <ul>
                                 <li v-for="(shipping, index) in user.shipping" :key="index" class="list-group-item list-group-item-action">
                                    <input class="address-select" type="radio" :value="shipping.id" @click="setAddressID" name="shipping"> {{shipping.address}}, {{shipping.thana}}, {{shipping.district}},  {{shipping.phone}},
                                </li>
                            </ul>
                            <button class="btn btn-success btn-block" @click="addNewAddress"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            <div v-if="addressPlus">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Name</label>
                                        <input type="text" readonly class="form-control" :value="user.name">
                                    </div>
                                    <div class="col-6">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="address.phone" name="phone" placeholder="+880-123-XXX-XXXX">
                                    </div>
                                </div>
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="address.address" name="address" placeholder="Address">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Area</label>
                                        <input type="text" class="form-control" v-model="address.area" name="area" placeholder="Area">
                                    </div>
                                    <div class="col-6">
                                        <label>Thana <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="address.thana" name="thana" placeholder="Thana">
                                    </div>
                                    <div class="col-6">
                                        <label>District <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" v-model="address.district" name="district" placeholder="District">
                                    </div>
                                    <div class="col-6">
                                        <label>Post Code</label>
                                        <input type="text" class="form-control" v-model="address.post_code" name="post_code" placeholder="ZIP">
                                    </div>
                                </div>
                                <label>Landmarks</label>
                                <textarea  class="form-control" v-model="address.landmarks" name="landmarks" placeholder="Landmarks"></textarea>
                            </div>
                        </div>
                        <div class="card-header">
                               <h3 class="mb-0 text-center">Payment Methods</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method"> Cash On Delivery</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method"> Mobile Banking</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method"> Bank Transfer</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method"> Card VISA/MasterCard</li>
                                 <li class="list-group-item list-group-item-action"><input type="radio" name="payment_method"> Cheque</li>
                            </ul>
                            <button  class="btn btn-success btn-block mt-2 mb-2" @click="saveAddress()">Confirm Order</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                             <h3 class="mb-0 text-center">Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td>Item</td>
                                    <th>{{summary.quantity}}</th>
                                </tr>
                                <tr>
                                    <td>Sub Total</td>
                                    <th>৳  {{summary.total}}</th>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <th>৳ {{summary.total}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5" v-else>
                <h1 class="text-center text-danger">Cart is empty</h1>
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
            imgUrl : window.location.origin+'/frontend/assets/uploads/products/',
            address:{},
            user: {},
            addressPlus: false,
            shippingAddressId: null,
        }
    },
    created(){
        this.url = this.url+'/frontend/assets/home-images/'
        this.getCartItems()
        this.summaryUpdate()
        this.getUserInformation()
    },
    methods:{
        getCartItems() {
            axios.get(this.apiUrl+'/api/get_cart_items').then(res=>{
                this.carts = res.data.data
                this.summaryUpdate()
            })
        },
        summaryUpdate(){
            this.summary.total= 0;
            this.summary.quantity= 0;
            this.carts.forEach((cart , i)=>{
                if (cart.product.offer_price!=null){
                    this.summary.total += parseFloat(cart.product.offer_price)*parseFloat(cart.quantity)
                }else{
                    this.summary.total += parseFloat(cart.product.selling_price)*parseFloat(cart.quantity)
                }
                this.summary.quantity += parseFloat(cart.quantity);
            })
        },
        updateCartQuantity(quantity, cart_id){
            axios.put(this.apiUrl+'/api/cart/'+cart_id, {quantity:quantity}).then(res=>{
                console.log(res)
            })
        },
        removeCartItem(cart_id){
            if(confirm('Are you sure?')){
                axios.delete(this.apiUrl+'/api/cart/'+cart_id).then(res=>{
                    console.log(res)
                })
                this.getCartItems()
            }
        },
        setAddressID(event){
            this.shippingAddressId = event.target.value;
        },
        addNewAddress(){
            this.addressPlus= true
            $(".address-select").prop('checked', false)
            this.shippingAddressId = null
             this.address.shipping_address_id= null

        },
        saveAddress(){
            // axios.post(this.apiUrl+'/api/shipping-address', this.address).then(res=>{
            //     console.log(res.data)
            // })
            if(this.shippingAddressId!=null){
                this.address.shipping_address_id = this.shippingAddressId
            }else{
                if(this.address.address == null || this.address.phone == null || this.address.thana== null || this.address.district==null){
                    alert('* Marked Fileds Are Required')
                    e.preventDefault();
                }
            }

            //place order
            if(confirm('Are you sure?')){
                axios.post(this.apiUrl+'/api/order', this.address).then(res=>{
                    //redirect
                    $('#cartCount').text(0)
                    this.$router.push({ name: 'OrderConfirm' })
                })
            }
        },
        getUserInformation(){
            axios.get(this.apiUrl+'/api/user').then(res=>{
                this.user = res.data;
            })
        }
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
.right_side {
    border-left: 2px solid #F1F1F1;
    border-right: 2px solid #F1F1F1;
}
.cart_image {
    background-color: #F1F1F1;
    text-align: center;
    padding: 10px 5px;
    border: 1px solid silver;
    border-radius: 5px;
    vertical-align: middle;
}

.right_bar ul {
    list-style: none;
}
.right_bar ul li:first-child{
    margin-left: 0 !important;
}
.right_bar ul li {
    float: left;
    margin-left: 22%;
}

.product_name{
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
    padding: 5px 7px;
    background-color: red;
    border-radius: 33%;
    color: #fff;
    position: absolute;
    right: -1px;
    top: -1px;
}

.btn_color {
    background-color: #6ABD48;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
}
.single-cart_item{
    border: 1px solid silver;
    border-radius: 10px;
}
.cart-update-area{
    display: inline-flex;
}
input.cart-update-input {
    width: 50%;
    outline:none!important;
    border: 1px solid silver;
}
input.cart-update-input:focus {
    outline:none!important;
}
.summary-area{
    border: 1px solid silver;
    border-radius: 10px;
    padding-top: 10px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
label{
    margin-bottom: 0;
    margin-top: 10px;
}
.card{
    margin-bottom: 100px;
}
.list-group-item{
    cursor: pointer;
}
</style>
