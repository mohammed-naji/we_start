<script setup>
import { onMounted, ref } from "vue";
import { useUserStore } from '../stores/user'
import { useRouter, useRoute } from "vue-router";

const router = useRouter();

const user = useUserStore();

    let name = ref(); 
    let email = ref(); 
    let phone = ref(); 
    let password = ref();
    let password_confirmation = ref();
    let error = ref('')

    const register = () => {
        axios.post('/register', {
            name: name.value,
            email: email.value,
            phone: phone.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        })
        .then(res => {
            user.updateUser(res.data.data.user)
            user.updateToken(res.data.data.token)
            router.push('/otp')
        })
        .catch(err => {
          error.value = err.response.data.message
        })
    }

</script>
<template>
  <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <div v-if="error" class="p-5 text-red-800 rounded my-4 bg-red-200">
                <p class="m-0">{{ error }}</p>
            </div>
            <h2 class="text-2xl uppercase font-medium mb-1">Register New Account</h2>
            <form action="#" @submit.prevent="register" method="post" autocomplete="off">
                <div class="space-y-2">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">Name</label>
                        <input type="text" name="name" id="name" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Name" v-model="name">
                    </div>
                    
                    <div>
                        <label for="phone" class="text-gray-600 mb-2 block">Phone</label>
                        <input type="text" name="phone" id="phone" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Phone" v-model="phone">
                    </div>
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="youremail.@domain.com" v-model="email">
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******" v-model="password" autocomplete="new-password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-gray-600 mb-2 block">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******" v-model="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Register</button>
                </div>
            </form>

            <p class="mt-4 text-center text-gray-600">Have account? <router-link to="/login" class="text-primary">Login
                    now</router-link></p>
        </div>
    </div>
</template>
