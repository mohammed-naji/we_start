<script setup>
import { RouterLink, RouterView } from "vue-router";
import { useRouter, useRoute } from "vue-router";
import { onMounted, ref } from "@vue/runtime-core";
import { useUserStore } from "./stores/user";

const user = useUserStore();

const logout = () => {
  user.logOutUser()

  // return false;
}
const lang = ref('')

onMounted(e => {
  lang.value = localStorage.getItem('locale') ?? 'ar';
  user.updateCart();
})




const chanegLang = (e) => {
  lang.value = e.$i18n.locale
  localStorage.setItem('locale', e.$i18n.locale)
}


</script>

<template>
  <div :class="{rtl : lang == 'ar'}">
    <!-- header -->
  <header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
      <RouterLink to="/">
        <img src="src/assets/images/logo.svg" alt="Logo" class="w-32" />
      </RouterLink>

      <div class="w-full max-w-xl relative flex">
        <span class="absolute left-4 top-3 text-lg text-gray-400">
          <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input type="text" name="search" id="search"
          class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none"
          placeholder="search" />
        <button
          class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">
          Search
        </button>
      </div>

      <div class="flex items-center space-x-4">
        <RouterLink to="/wishlist" class="text-center text-gray-700 hover:text-primary transition relative" activeClass="text-primary">
          <div class="text-2xl">
            <i class="fa-regular fa-heart"></i>
          </div>
          <div class="text-xs leading-3">Wishlist</div>
          <div
            class="absolute right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
            8
          </div>
        </RouterLink>
        <RouterLink to="/cart" class="text-center text-gray-700 hover:text-primary transition relative" activeClass="text-primary">
          <div class="text-2xl">
            <i class="fa-solid fa-bag-shopping"></i>
          </div>
          <div class="text-xs leading-3">Cart</div>
          <div
            class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
            <!-- {{ user.user }} -->
            {{ user.cart ? user.cart.length : 0 }}
          </div>
        </RouterLink>
        <RouterLink to="/account" class="text-center text-gray-700 hover:text-primary transition relative" activeClass="text-primary">
          <div class="text-2xl">
            <i class="fa-regular fa-user"></i>
          </div>
          <div class="text-xs leading-3">Account</div>
        </RouterLink>
      </div>
    </div>
  </header>
  <!-- ./header -->

  <!-- navbar -->
  <nav class="bg-gray-800">
    <div class="container flex">
      <div class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group">
        <span class="text-white">
          <i class="fa-solid fa-bars"></i>
        </span>
        <span class="capitalize ml-2 text-white">All Categories</span>

        <!-- dropdown -->
        <div
          class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
          <RouterLink to="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
            <span class="text-gray-600 text-sm">Sofa</span>
          </RouterLink>
        </div>
      </div>

      <div class="flex items-center justify-between flex-grow pl-12">
        <div class="flex items-center space-x-6 capitalize">
          <RouterLink to="/" class="text-gray-200 hover:text-white transition">Home</RouterLink>
          <RouterLink to="/shop" class="text-gray-200 hover:text-white transition">Shop</RouterLink>
          <RouterLink to="/about-us" class="text-gray-200 hover:text-white transition">About Us</RouterLink>
          <RouterLink to="/contact-us" class="text-gray-200 hover:text-white transition">Contact Us</RouterLink>
          <RouterLink to="/checkout" class="text-gray-200 hover:text-white transition">Checkout</RouterLink>
        </div>
        <div>
          <template v-if="user.user">
            <!-- <RouterLink @click.prevent="logout" to="/logout" class="text-gray-200 ml-4 hover:text-white transition" disabled>Logout</RouterLink> -->
            <a @click.prevent="logout" href="/logout" class="text-gray-200 ml-4 hover:text-white transition">Logout</a>
          </template>
          <template v-else>
            <RouterLink to="/login" class="text-gray-200 ml-4 hover:text-white transition">Login</RouterLink>
            <RouterLink to="/register" class="text-gray-200 ml-4 hover:text-white transition">Register</RouterLink>
          </template>
          <select v-model="$i18n.locale" @change="chanegLang(this)">
            <option v-for="locale in $i18n.availableLocales" :key="`locale-${locale}`" :value="locale">{{ locale }}</option>
          </select>
        </div>
        <!-- <div>
          <RouterLink to="/login" class="text-gray-200 ml-4 hover:text-white transition">Login</RouterLink>
          <RouterLink to="/register" class="text-gray-200 ml-4 hover:text-white transition">Register</RouterLink>
        </div> -->
      </div>
    </div>
  </nav>
  <!-- ./navbar -->
  
  <RouterView />

  <!-- footer -->
  <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grid-cols-3">
      <div class="col-span-1 space-y-8">
        <img src="src/src/assets/images/logo.svg" alt="logo" class="w-30" />
        <div class="mr-2">
          <p class="text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, hic?
          </p>
        </div>
        <div class="flex space-x-6">
          <a href="#" class="text-gray-400 hover:text-gray-500"><i class="fa-brands fa-facebook-square"></i></a>
          <a href="#" class="text-gray-400 hover:text-gray-500"><i class="fa-brands fa-instagram-square"></i></a>
          <a href="#" class="text-gray-400 hover:text-gray-500"><i class="fa-brands fa-twitter-square"></i></a>
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <i class="fa-brands fa-github-square"></i>
          </a>
        </div>
      </div>

      <div class="col-span-2 grid grid-cols-2 gap-8">
        <div class="grid grid-cols-2 gap-8">
          <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">
              Solutions
            </h3>
            <div class="mt-4 space-y-4">
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">
              Support
            </h3>
            <div class="mt-4 space-y-4">
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">
              Solutions
            </h3>
            <div class="mt-4 space-y-4">
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">
              Support
            </h3>
            <div class="mt-4 space-y-4">
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
              <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ./footer -->

  <!-- copyright -->
  <div class="bg-gray-800 py-4">
    <div class="container flex items-center justify-between">
      <p class="text-white">&copy; TailCommerce - All Right Reserved</p>
      <div>
        <img src="src/assets/images/methods.png" alt="methods" class="h-5" />
      </div>
    </div>
  </div>
  <!-- ./copyright -->
  </div>
</template>

<style>
body {
    font-family: Poppins, sans-serif;
}

body .rtl {
  direction: rtl;
}
</style>