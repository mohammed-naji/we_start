import { defineStore } from 'pinia'

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    user: null
  }),
  getters: {
    getUser: (state) => state.user
  },
  actions: {
    updateUser(user) {
      this.user = user
    }
  },
  persist: true,
})
