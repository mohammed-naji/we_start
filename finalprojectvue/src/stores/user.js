import axios from 'axios'
import { defineStore } from 'pinia'

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    user: null,
    token: null,
    cart: null
  }),
  getters: {
    getUser: (state) => state.user,
    getToken: (state) => state.token,
  },
  actions: {
    updateUser(user) {
      this.user = user
    },
    updateToken(token) {
      this.token = token
    },
    updateCart() {

      let user_token = localStorage.getItem('user_token');
      if(!user_token) {
        let token = Math.floor(Math.random() * 99999) +""+ Math.floor(Math.random() * 99999) +""+ Math.floor(Math.random() * 99999);
        localStorage.setItem('user_token', token)
      }

      let user_id = user_token
      if(this.user) {
        user_id = this.user.id
      }

      axios.get('/cart', {
        params: {
          user_id: user_id,
        }
      })
      .then(res => {
        this.cart = res.data
      })
    },
    addToCart(product_id, qty = 1) {

      let user_token = localStorage.getItem('user_token');
      if(!user_token) {
        let token = Math.floor(Math.random() * 99999) +""+ Math.floor(Math.random() * 99999) +""+ Math.floor(Math.random() * 99999);
        localStorage.setItem('user_token', token)
      }

      let user_id = user_token
      if(this.user) {
        user_id = this.user.id
      }

      axios.post('/add-to-cart', {
        product_id: product_id,
        quantity: qty,
        user_id: user_id
      })
      .then(res => {
        this.updateCart();
      })
    },
    logOutUser() {
      this.user = null,
      this.token =null,
      this.updateCart();
    },
    addCartToUser() {
      let user_token = localStorage.getItem('user_token');
      axios.post('/assign-cart-to-user', {
        user_token: user_token,
        user_id : this.user.id
      })
      .then(res => {
        this.cart = res.data;
      })
    },
    updateOtp(time) {
      this.user.otp_verified_at = time
    }
  },
  persist: true,
})
