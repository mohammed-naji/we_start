<script setup>
import { loadStripe } from '@stripe/stripe-js'
import { onMounted, ref } from 'vue';
import { useRouter } from "vue-router";
import { useUserStore } from "../stores/user";

const router = useRouter();
const user = useUserStore();

const stripe = ref({})
const cardElement = ref({});
const customer = ref({});
const amount = ref(0);
const paymentProcessing = ref(false);

onMounted(async e => {
    stripe.value = await loadStripe("pk_test_51MFWp5GviNwj0jAitwYxHRwTMb4rfjRRl0Py2pC77K9Ldr3UrQFDJi0K4TNnoILtXxGS95agDRMU5LZmoaKFaKhD00OeLXxqqW");

    const elements = stripe.value.elements();

    cardElement.value = elements.create('card', {
        classes: {
            base: 'input-box'
        }
    });

    cardElement.value.mount('#card-element');
})

const processPayment = async () => {
paymentProcessing.value = true;
const {paymentMethod, error} = await stripe.value.createPaymentMethod(
    'card', cardElement.value, {
        billing_details: {
            name: user.user.name,
            email: user.user.email,
            address: {
                line1: user.user.country,
                city: user.user.city,
                state: user.user.street,
                postal_code: user.user.zipcode
            }
        }
    }
);

if (error) {
    paymentProcessing.value = false;
    console.error(error);
} else {

    customer.value.payment_method_id = paymentMethod.id
    customer.value.amount = amount.value

    const config = {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${user.token}`
        }
    }

    axios.post('/account-charge', customer.value, config)
        .then((res) => {
            paymentProcessing.value = false;

            if(res.data.status == 1) {
                user.refreshUser();
                toastr.success(res.data.message)
                router.push('/account')
            }else {
                toastr.error(res.data.message)
            }

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
        <p class="text-gray-600 font-medium">Account</p>
    </div>
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

<!-- sidebar -->
<div class="col-span-3">
    <div class="px-4 py-3 shadow flex items-center gap-4">
        <div class="flex-shrink-0">
            <img src="../assets/images/avatar.png" alt="profile" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
        </div>
        <div class="flex-grow">
            <p class="text-gray-600">Hello,</p>
            <h4 class="text-gray-800 font-medium">John Doe</h4>
        </div>
    </div>

    <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
        <div class="space-y-1 pl-8">
            <a href="#" class="relative text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-address-card"></i>
                </span>
                Manage account
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Profile information
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Manage addresses
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                Change password
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-solid fa-box-archive"></i>
                </span>
                My order history
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My returns
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My Cancellations
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My reviews
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-credit-card"></i>
                </span>
                Payment methods
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                voucher
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-heart"></i>
                </span>
                My wishlist
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-arrow-right-from-bracket"></i>
                </span>
                Logout
            </a>
        </div>

    </div>
</div>
<!-- ./sidebar -->

<!-- info -->
<div class="col-span-9 grid grid-cols-2 gap-4">



    <div class="shadow rounded bg-white px-4 pt-6 pb-8">
        <input type="number" v-model="amount" class="input-box mb-3" placeholder="Amount" />
        <div id="card-element" class="mb-3">

        </div>

        <button @click="processPayment" class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium" v-text="paymentProcessing ? 'Charging' : 'Charge' "></button>
    </div>

</div>
<!-- ./info -->

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