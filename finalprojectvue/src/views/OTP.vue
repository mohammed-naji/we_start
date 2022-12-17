<script setup>
import axios from "axios";
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from '../stores/user'
const router = useRouter();


const focusNext = (e) => {
    var regex = /[0-9]|/;
        if( !regex.test(e.target.value)) {
            return;
        }

    if(e.keyCode == 27 || e.keyCode == 8) {
        if(e.target.previousElementSibling) {
            e.target.previousElementSibling.value = '';
            e.target.previousElementSibling.focus();
        }
    }else {
        if(e.target.nextElementSibling) {
            e.target.nextElementSibling.focus();
        }
    }
    
}

const number = ref({
    n1: null,
    n2: null,
    n3: null,
    n4: null,
    n5: null,
    n6: null,
})

const user = useUserStore();

const config = {
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${user.token}`
    }
}

const applyOTP = () => {
    
    // console.log(number.value);

    axios.post('/verify-otp', {
        number: number.value
    }, config)
    .then(res => {
        user.updateOtp(res.data)
        router.push('/');
    })

}

</script>
<template>
  <div class="contain py-16">
        <div class="max-w-lg mx-auto text-center shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">OTP</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Verify your registration
            </p>
            <form action="#" method="post" autocomplete="off">
                <div class="grid grid-cols-6 gap-2">
                    <input @keyup="focusNext" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n1" />
                    <input @keyup="focusNext" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n2" />
                    <input @keyup="focusNext" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n3" />
                    <input @keyup="focusNext" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n4" />
                    <input @keyup="focusNext" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n5" />
                    <input @keyup="applyOTP" class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" maxlength="1" v-model="number.n6" />
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
</style>