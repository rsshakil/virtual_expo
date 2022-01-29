export default{
    data(){

        return{
            url:window.location.origin,
            imageUrl:'',
            isNavbar:true,
            isFooter:true,
            soundUrl:''

        }
    },

    created(){
        this.soundUrl = this.url+'/sound'
        this.imageUrl = this.url+'/frontend/assets/home-images/'
    }
}
