<template>
    <body class="overflow-hidden">
        <div class="flex items-center flex-col justify-center lg:flex-row py-28 px-6 md:px-24 md:py-20 lg:py-32 gap-16 lg:gap-28">
            <div class="w-full lg:w-1/2">
                <img class="hidden lg:block" src="https://i.ibb.co/v30JLYr/Group-192-2.png" />
                <img class="hidden md:block lg:hidden" src="https://i.ibb.co/c1ggfn2/Group-193.png" />
                <img class="md:hidden" src="https://i.ibb.co/8gTVH2Y/Group-198.png" />
            </div>
            <div class="w-full lg:w-1/2">
                <h1 class="py-4 text-3xl lg:text-4xl font-extrabold text-gray-800">Looks like you've found the doorway to the great nothing</h1>
                <p class="py-4 text-base text-gray-800">The content you’re looking for doesn’t exist. Either it was removed, or you mistyped the link.</p>
                <p class="py-2 text-base text-gray-800">Sorry about that! Please visit our hompage to get where you need to go.</p>
                <router-link to="/" class="w-full inline-block lg:w-auto my-4 border rounded-md px-1 sm:px-16 py-5 bg-primary text-white hover:bg-transparent hover:text-primary focus:outline-none transition focus:ring-opacity-50">Go back to Homepage</router-link>
            </div>
        </div>
    </body>
</template>

<script>
export default {
    name: "MyComponent",
    data() {
        return {            
        }
    },
    methods: {        
    },
    mounted() {}
};
</script>

<style scoped>

</style>
