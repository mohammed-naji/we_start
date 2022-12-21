<script setup>
import axios from "axios";
import { computed, onMounted, ref } from "vue";
import { useUserStore } from "../stores/user";

const user = useUserStore();

const paymentMethod = ref('cards')
const disabled = ref(true)

onMounted(e => {
  console.log(user.user.wallet);
})

const cartTotal = computed((e) => {
  let total = 0;
  user.cart.forEach(el => {
    total += el.price * el.quantity
  })
  return total;
})

const checkWallet = () => {
  // console.log(cartTotal.value);
  axios.get(`/check-user-wallet/${user.user.id}/${cartTotal.value}`)
  .then(res => {
    console.log(res);
  })
}


</script>

<template>
  <div class="container py-4 flex items-center gap-3">
    <a href="../index.html" class="text-primary text-base">
      <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
      <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Profile</p>
  </div>

  <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">
    <!-- wishlist -->
    <div class="col-span-8 space-y-4">
      <div v-for="cart in user.cart" :key="cart.id" class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
        <!-- {{ cart }} -->
        <div class="w-28">
          <img :src="cart.product.image" alt="product 6" class="w-full" />
        </div>
        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">
            {{ cart.product.name }}
          </h2>
        </div>

        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">
            {{ cart.quantity }}
          </h2>
        </div>

        <div class="w-1/3">
          <h2 class="text-gray-800 text-xl font-medium uppercase">
            {{ cart.price }}
          </h2>
        </div>

        <div class="text-primary text-lg font-semibold">${{ cart.quantity * cart.price }}</div>

        <div class="text-gray-600 cursor-pointer hover:text-primary">
          <i class="fa-solid fa-trash"></i>
        </div>
      </div>

    </div>
    <div class="col-span-4">
      <div class="p-4 border rounded">
        <h2 class="text-gray-800 text-xl font-medium uppercase">Order Summary</h2>

        <div class="flex justify-between my-4">
          <h3 class="text-xl font-bold">Total</h3>
          <h3 class="text-xl font-bold text-teal-600">${{ cartTotal }}</h3>
        </div>
        <hr>

        <h3 class="font-semibold mb-4 mt-3">Choose your payment method</h3>
        <label class="block"><input type="radio" value="cards" v-model="paymentMethod"> Credit Cards</label>
        <label class="block"><input :disabled="user.user.wallet < cartTotal" type="radio" value="wallet" v-model="paymentMethod" @change="checkWallet"> Wallet</label>
        <label class="block"><input type="radio" value="points" v-model="paymentMethod" @change="checkPoints"> Points</label>
        <label class="block"><input type="radio" value="cash" v-model="paymentMethod"> Cash on Delivery</label>

        <hr class="my-5">
        <router-link :to="'/checkout/'+paymentMethod" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Place
        order</router-link>

      </div>
    </div>
    <!-- ./wishlist -->
  </div>
</template>
