import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'



Vue.use(Vuex)

axios.defaults.baseURL = window.location.origin + '/api'

export default new Vuex.Store({
    state: {
        user: null
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData
            // console.log(userData[0]['message']);
            if(userData.token){

            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}` 

            } else {
                localStorage.setItem('error', JSON.stringify(userData))
            }
           
        },

        clearUserData() {
            localStorage.removeItem('user')
            location.reload()
        }
    },

    actions: {
        signIn({ commit }, credentials) {
            return axios
                .post('/client-signin', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                   
                    // let user = data.user 
                  if(data.user){

                   window.location.href = window.location.origin+'/lobby'  
                      
                  }
                })
        },

        signOut({ commit }) {
            commit('clearUserData')
            window.location.href = window.location.origin+'/lobby'
        }
    },

    getters: {
        isLogged: state => !!state.user,
        user: state => state.user,
        
    }
})
