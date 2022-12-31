<script setup>

import { loadStripe } from '@stripe/stripe-js'
import { onMounted, ref } from "vue";
import { useUserStore } from "../stores/user";
import { useRouter } from "vue-router";

const router = useRouter();
const user = useUserStore();

const loggedinuser = ref({
    name: user.user.name,
    email: user.user.email,
    phone: user.user.phone,
    country: user.user.country,
    city: user.user.city,
    street: user.user.street,
    zipcode: user.user.zipcode,
})

// const aa = user.user

// const loggedinuser = ref(aa)

let props = defineProps({
    type: {
        type: String
    }
})

const stripe = ref({});
const cardElement = ref({});
const customer = ref({});
const paymentProcessing = ref(false);
const accept = ref(0);

onMounted( async e => {
    if(props.type.length == 0 || props.type == 'cards') {
        stripe.value = await loadStripe("pk_test_51MFWp5GviNwj0jAitwYxHRwTMb4rfjRRl0Py2pC77K9Ldr3UrQFDJi0K4TNnoILtXxGS95agDRMU5LZmoaKFaKhD00OeLXxqqW");

        const elements = stripe.value.elements();

        cardElement.value = elements.create('card', {
            classes: {
                base: 'input-box'
            }
        });

        cardElement.value.mount('#card-element');
    }
})

const processPayment = async () => {
paymentProcessing.value = true;
let err = false;
let pMethod = '';
if(props.type.length == 0 || props.type == 'cards') {
    const {paymentMethod, error} = await stripe.value.createPaymentMethod(
        'card', cardElement.value, {
            billing_details: {
                name: loggedinuser.name,
                email: loggedinuser.email,
                address: {
                    line1: loggedinuser.country,
                    city: loggedinuser.city,
                    state: loggedinuser.street,
                    postal_code: loggedinuser.zipcode
                }
            }
        }
    );

    err = error;
    pMethod = paymentMethod;
    // if (error) {
    //     paymentProcessing.value = false;
    //     console.error(error);
    // } 
}

if (err) {
    paymentProcessing.value = false;
    console.error(error);
} else {
    // console.log(pMethod);
    if(pMethod) {
        customer.value.payment_method_id = paymentMethod.id
    }else {
        customer.value.payment_method_id = ''
    }
    customer.value.amount = user.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    customer.value.user = loggedinuser;
    customer.value.type = props.type;

    const config = {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${user.token}`
        }
    }

    axios.post('/purchase', customer.value, config)
        .then((res) => {
            console.log(res);
            paymentProcessing.value = false;

            if(res.data.status == 1) {
                user.updateCart();
                user.refreshUser();
                toastr.success(res.data.message)
                router.push('/')
            }else {
                toastr.error(res.data.message)
            }

            

            // this.$store.commit('updateOrder', response.data);
            // this.$store.dispatch('clearCart');

            // this.$router.push({ name: 'order.summary' });
        })
        .catch((error) => {
            paymentProcessing.value = false;
            console.error(error);
        });
}
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
        <p class="text-gray-600 font-medium">Checkout</p>
    </div>
    <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">

<div class="col-span-8 border border-gray-200 p-4 rounded">
    <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
    <div class="space-y-4">
        <div>
            <label for="first-name" class="text-gray-600">Full Name <span class="text-primary">*</span></label>
            <input type="text" disabled name="first-name" id="first-name" class="input-box" v-model="loggedinuser.name">
        </div>
        <div>
            <label for="email" class="text-gray-600">Email address</label>
            <input type="email" disabled name="email" id="email" class="input-box" v-model="loggedinuser.email">
        </div>
        <div>
            <label for="phone" class="text-gray-600">Phone number</label>
            <input type="text" disabled name="phone" id="phone" class="input-box" v-model="loggedinuser.phone">
        </div>

        <div>
            <label for="region" class="text-gray-600">Country/Region</label>
            <input type="text" name="region" id="region" class="input-box" v-model="loggedinuser.country">
        </div>

        <div>
            <label for="city" class="text-gray-600">City</label>
            <input type="text" name="city" id="city" class="input-box" v-model="loggedinuser.city">
        </div>

        <div>
            <label for="address" class="text-gray-600">Street address</label>
            <input type="text" name="address" id="address" class="input-box" v-model="loggedinuser.street">
        </div>
        
        <div>
            <label for="company" class="text-gray-600">Zip Code</label>
            <input type="text" name="company" id="company" class="input-box" v-model="loggedinuser.zipcode">
        </div>

        <div v-if="props.type.length == 0 || props.type=='cards'" class="flex flex-wrap -mx-2 mt-4">
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="card-element" class="leading-7 text-sm text-gray-600">Credit Card Info</label>
                        <div id="card-element"></div>
                    </div>
                </div>
            </div>
    </div>

</div>

<div class="col-span-4 border border-gray-200 p-4 rounded">
    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">order summary</h4>
    <div class="space-y-2">
        <div class="flex justify-between">
            <div>
                <h5 class="text-gray-800 font-medium">Italian shape sofa</h5>
                <p class="text-sm text-gray-600">Size: M</p>
            </div>
            <p class="text-gray-600">
                x3
            </p>
            <p class="text-gray-800 font-medium">$320</p>
        </div>
        <div class="flex justify-between">
            <div>
                <h5 class="text-gray-800 font-medium">Italian shape sofa</h5>
                <p class="text-sm text-gray-600">Size: M</p>
            </div>
            <p class="text-gray-600">
                x3
            </p>
            <p class="text-gray-800 font-medium">$320</p>
        </div>
        <div class="flex justify-between">
            <div>
                <h5 class="text-gray-800 font-medium">Italian shape sofa</h5>
                <p class="text-sm text-gray-600">Size: M</p>
            </div>
            <p class="text-gray-600">
                x3
            </p>
            <p class="text-gray-800 font-medium">$320</p>
        </div>
        <div class="flex justify-between">
            <div>
                <h5 class="text-gray-800 font-medium">Italian shape sofa</h5>
                <p class="text-sm text-gray-600">Size: M</p>
            </div>
            <p class="text-gray-600">
                x3
            </p>
            <p class="text-gray-800 font-medium">$320</p>
        </div>
    </div>

    <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
        <p>subtotal</p>
        <p>$1280</p>
    </div>

    <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
        <p>shipping</p>
        <p>Free</p>
    </div>

    <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
        <p class="font-semibold">Total</p>
        <p>$1280</p>
    </div>

    <div class="flex items-center mb-4 mt-2">
        <input type="checkbox" name="aggrement" id="aggrement" class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3" value="1" v-model="accept">
        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a href="#" class="text-primary">terms &amp; conditions</a></label>
    </div>

    <button @click="processPayment" :disabled="!accept" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium" v-text="paymentProcessing ? 'Proccessing' : 'Place Order' "></button>


</div>

</div>
</template>

<style>
.input-box {
  display: block;
  width: 100%;
  border-radius: 0.25rem;
  border-width: 1px;
  --tw-border-opacity: 1;
  border-color: rgb(209 213 219 / var(--tw-border-opacity));
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  --tw-text-opacity: 1;
  color: rgb(75 85 99 / var(--tw-text-opacity));
}

</style>