import { defineStore } from 'pinia'

// export const useUserStore = defineStore({
const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    name: '',
    age: '',
    country: ''
  }),
  getters: {
    showUser: (state) => state.name,
    showFullName: (state) => state.name + ' ' + state.age
  },
  actions: {
    UpdateUser(user) {
      this.name = user
    }
  }
})

export default useUserStore