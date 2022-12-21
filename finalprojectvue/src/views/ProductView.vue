<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import { onBeforeRouteUpdate } from "vue-router";
import { useUserStore } from "../stores/user";
import StarsRating from "../components/rating-stars.vue"
const user = useUserStore();

let props = defineProps({
  slug: {
    type: String,
  },
});

onBeforeRouteUpdate((from, to) => {
    getProduct(from.params.slug);
    getRelatedProduct();
})

const product = ref({});
const related_products = ref({});
const active_el = ref(0);
const main_img = ref("");

const cart = ref({
  product_id: null,
  quantity: 1,
  color: null,
  size: null,
});

onMounted((e) => {
  getProduct();
  getRelatedProduct();
});

const getProduct = (slug = props.slug) => {
    console.log(slug);
  axios.get("/products/" + slug).then((res) => {
    product.value = res.data.data;
  });
};

const getRelatedProduct = () => {
  setTimeout(() => {
    axios
      .get(`/related_products/${product.value.id}/${product.value.category_id}`)
      .then((res) => {
        related_products.value = res.data.data;
      });
  }, 500);
};

const activate = (i, path) => {
  active_el.value = i;
  main_img.value = path;
};

const pageUrl = window.location.href;

const add_to_cart = (id) => {
  user.addToCart(id, cart.value.quantity)
  toastr.success("Product added to cart")
}

</script>

<template>
  {{ product }}
  {{ $t('hello') }}
  
  <div class="container py-4 flex items-center gap-3">
    <a href="../index.html" class="text-primary text-base">
      <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
      <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">{{ product.name }}</p>
  </div>

  <div class="container grid grid-cols-2 gap-6">
    <div>
      <img
        :src="main_img ? main_img : product.image"
        alt="product"
        class="w-full main-image"
      />
      <div class="grid grid-cols-5 gap-4 mt-4 gallery">
        <img
          v-for="(img, i) in product.gallery"
          :key="i"
          :src="img.path"
          alt="product2"
          class="w-full cursor-pointer border"
          :class="{ 'border-primary': active_el == i }"
          @click="activate(i, img.path)"
        />
      </div>
    </div>

    <div>
      <h2 class="text-3xl font-medium uppercase mb-2">{{ product.name }}</h2>
      <div class="flex items-center mb-4" v-if="product.reviews && product.reviews.count > 0">
        <div class="flex gap-1 text-sm text-yellow-400">
            <StarsRating :rating="product.reviews.rate"></StarsRating>
        </div>
        <div class="text-xs text-gray-500 ml-3">({{ product.reviews.count }} Reviews)</div>
      </div>
      <div class="space-y-2">
        <p class="text-gray-800 font-semibold space-x-2">
          <span>Availability: </span>
          <template v-if="product.quantity > 0">
            <span class="text-green-600">In Stock</span>
          </template>
          <template v-else>
            <span class="text-red-600">Out Of Stock</span>
          </template>
        </p>
        <p class="space-x-2">
          <span class="text-gray-800 font-semibold">Category: </span>
          <span class="text-gray-600">{{
            product.category ? product.category.name : ""
          }}</span>
        </p>
      </div>
      <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
        <template v-if="product.coupons">
          <p class="text-xl text-primary font-semibold">
            ${{ product.final_price }}
          </p>
          <p class="text-sm text-gray-400 line-through">${{ product.price }}</p>
        </template>
        <template v-else>
          <p class="text-xl text-primary font-semibold">${{ product.price }}</p>
        </template>
      </div>

      <p class="mt-4 text-gray-600">{{ product.short }}</p>

      <div
        class="pt-4"
        v-if="product.variations && product.variations.sizes.length > 0"
      >
        <h3 class="text-gray-800 mb-3 uppercase font-medium">
          Size
          <small
            class="cursor-pointer"
            @click="cart.size = null"
            v-if="cart.size"
            >x</small
          >
        </h3>
        <div class="flex items-center gap-2">
          <div
            class="size-selector"
            v-for="size in product.variations.sizes"
            :key="size.id"
          >
            <input
              type="radio"
              name="size"
              :id="'size-' + size.id"
              class="hidden"
              :value="size.id"
              v-model="cart.size"
            />
            <label
              :for="'size-' + size.id"
              class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
              >{{ size.value }}</label
            >
          </div>
        </div>
      </div>

      <div
        class="pt-4"
        v-if="product.variations && product.variations.colors.length > 0"
      >
        <h3 class="text-gray-800 mb-3 uppercase font-medium">
          Color
          <small
            class="cursor-pointer"
            @click="cart.color = null"
            v-if="cart.color"
            >x</small
          >
        </h3>
        <div class="flex items-center gap-2">
          <div
            class="color-selector"
            v-for="color in product.variations.colors"
            :key="color.id"
          >
            <input
              type="radio"
              name="color"
              :id="'color-' + color.id"
              class="hidden"
              :value="color.id"
              v-model="cart.color"
            />
            <label
              :for="'color-' + color.id"
              class="border border-gray-200 rounded-sm h-6 w-6 cursor-pointer shadow-sm block"
              :style="'background-color: ' + color.value"
            ></label>
          </div>
        </div>
      </div>

      <div class="mt-4">
        <h3 class="text-gray-800 uppercase font-medium mb-1">Quantity</h3>
        <div
          class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max"
        >
          <div
            @click="cart.quantity--"
            class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
          >
            -
          </div>
          <div class="h-8 w-8 text-base flex items-center justify-center">
            {{ cart.quantity }}
          </div>
          <div
            @click="cart.quantity++"
            class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
          >
            +
          </div>
        </div>
      </div>

      <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
        <button
          @click="add_to_cart(product.id)"
          class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition"
        >
          <i class="fa-solid fa-bag-shopping"></i> Add to cart
        </button>
        <a
          href="#"
          class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-primary transition"
        >
          <i class="fa-solid fa-heart"></i> Wishlist
        </a>
      </div>

      <div class="flex gap-3 mt-4">
        <a
          :href="`https://www.facebook.com/sharer.php?u=${pageUrl}`"
          class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
        >
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a
          :href="`https://twitter.com/share?url=${pageUrl}&text=${product.name}&via=mohnaji94`"
          class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
        >
          <i class="fa-brands fa-twitter"></i>
        </a>
        <a
          :href="`https://www.instagram.com/?url=${pageUrl}`"
          class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
        >
          <i class="fa-brands fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="container pb-16 mt-8">
    <h3
      class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium"
    >
      Product details
    </h3>
    <div class="w-3/5 pt-6">
      <div class="text-gray-600" v-html="product.desc"></div>

      <!-- <table class="table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6">
                <tbody><tr>
                    <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Color</th>
                    <th class="py-2 px-4 border border-gray-300 ">Blank, Brown, Red</th>
                </tr>
                <tr>
                    <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Material</th>
                    <th class="py-2 px-4 border border-gray-300 ">Latex</th>
                </tr>
                <tr>
                    <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Weight</th>
                    <th class="py-2 px-4 border border-gray-300 ">55kg</th>
                </tr>
            </tbody></table> -->
    </div>
  </div>

  <div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">
      Related products
    </h2>
    <div class="grid grid-cols-4 gap-6">
      <div
        v-for="related in related_products"
        :key="related.id"
        class="bg-white shadow rounded overflow-hidden group"
      >
        <div class="relative">
          <img
            style="height: 300px; object-fit: contain"
            :src="related.image"
            :alt="related.name"
            class="w-full"
          />
          <div
            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"
          >
            <a
              href="#"
              class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
              title="view product"
            >
              <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a
              href="#"
              class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
              title="add to wishlist"
            >
              <i class="fa-solid fa-heart"></i>
            </a>
          </div>
        </div>
        <div class="pt-4 pb-3 px-4">
          <router-link :to="'/product/' + related.slug">
            <h4
              class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition"
            >
              {{ related.name }}
            </h4>
          </router-link>
          <div class="flex items-baseline mb-1 space-x-2">
            <template v-if="related.coupons">
              <p class="text-xl text-primary font-semibold">
                <template v-if="related.coupons.type == 'value'">
                  ${{ related.price - related.coupons.value }}
                </template>
                <template v-else>
                  ${{
                    related.price -
                    (related.coupons.value / 100) * related.price
                  }}
                </template>
              </p>
              <p class="text-sm text-gray-400 line-through">
                ${{ related.price }}
              </p>
            </template>
            <template v-else>
              <p class="text-xl text-primary font-semibold">
                ${{ related.price }}
              </p>
            </template>
          </div>
          <div class="flex items-center">
            <div class="flex gap-1 text-sm text-yellow-400">
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
            </div>
            <div class="text-xs text-gray-500 ml-3">(150)</div>
          </div>
        </div>
        <button
          @click="add_to_cart(related.id)"
          class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition"
        >
          Add To Cart
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.main-image {
  height: 500px;
  object-fit: contain;
}

.gallery img {
  height: 120px;
  padding: 5px;
  object-fit: contain;
}
.size-selector input:checked + label {
  --tw-bg-opacity: 1;
  background-color: rgb(253 61 87 / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: rgb(255 255 255 / var(--tw-text-opacity));
}

.color-selector input:checked + label {
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0
    var(--tw-ring-offset-width) var(--tw-ring-offset-color);
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
    calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
    var(--tw-shadow, 0 0 #0000);
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(253 61 87 / var(--tw-ring-opacity));
}
</style>
