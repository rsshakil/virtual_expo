<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>Profile Edit</h3>
                </div>

                    <div class="col-md-6">
                        <div class="summary-area mt-3 mb-5">
                            <h3 class="text-center">User Name : </h3>
                            <div class="cart_list">
                                <div class="address-area">
                                    <input type="text" class="form-control mb-4" name="name" placeholder="Name">
                                    <input type="email" class="form-control mb-4" name="email" placeholder="Email">
                                    <input type="password" class="form-control mb-4" name="old_pass" placeholder="Old Password">
                                    <input type="password" class="form-control mb-4" name="password" placeholder="New Password">
                                    <input type="password" class="form-control mb-4" name="password_confirmation" placeholder="Confirm Password">
                                    <input type="file" class="form-control" name="image">

                                    <button  class="btn btn_color btn-block mt-2 mb-3" @click="profileUpdate()">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>

</template>

<script>
export default {

    // data(){
    //     return {
    //         url:window.location.origin,
    //         image:'',
    //         apiUrl : window.location.origin,
    //         carts:[],
    //         summary:[],
    //         imgUrl : window.location.origin+'/frontend/assets/uploads/products/',
    //         address:{},
    //     }
    // },

    methods: {
      profileUpdate(){

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

.product_name[data-v-3016b4dd] {
    font-size: 18px;
    font-weight: 500;
    line-height: 26px;
}

.offer_price[data-v-3016b4dd] {
    font-size: 22px;
    font-weight: 600;
}

.selling_price {
    text-decoration: line-through;
    color: red;
    font-size: 16px;
}
.total_price[data-v-3016b4dd][data-v-3016b4dd] {
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
.address-area {
    width: 90%;
    margin: 25px auto 0;
}
.address-area input{
    margin: 5px 0;
}
</style>
