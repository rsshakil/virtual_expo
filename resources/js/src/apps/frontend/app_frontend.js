require('../../bootstrap');
window.Vue = require('vue');
// import firebase from 'firebase'
// import '@firebase/analytics'
// import '@firebase/messaging'

import master from '../../../components/frontend/layouts/Master'
import router from '../../routes/frontend/router'
import store from '../../store/store-frontend'
import moment from 'moment'



Vue.component('Navbar', require('../../../components/frontend/layouts/Navbar').default);
Vue.component('FooterContent', require('../../../components/frontend/layouts/FooterContent').default);



const app = new Vue({
    router,moment,store,
    created() {
        const userInfo = localStorage.getItem("user");
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit("setUserData", userData);
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('singOut')
                }
                return Promise.reject(error)
            }
        )
    },
    render: h => h(master)
}).$mount('#app_frontend');