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
            if(userData.token && userData.user.role == 'Admin' || userData.user.role == 'Company' || userData.user.role == 'GeneralStaff' || userData.user.role == 'CustomerCare'){

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
                .post('/signin', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                   
                    let user = data.user 
                    console.log(data.user);
                  if(user.role == 'Admin' || user.role == 'Company' || user.role == 'GeneralStaff' || user.role == 'CustomerCare'){

                      window.location.href = window.location.origin+'/admin'  
                      
                  } else{
                    window.location.href = window.location.origin+'/admin/singin'  
                  }
                })
        },

        signOut({ commit }) {
            commit('clearUserData')
        }
    },

    getters: {
        isLogged: state => !!state.user,
        user: state => state.user,
        
    }
})
