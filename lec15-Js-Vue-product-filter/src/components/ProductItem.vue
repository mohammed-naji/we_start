<template>
    <div class="box">
        <img :src="product.image" alt="">
        <h3><router-link :to="{ name: 'singleProduct', params: {id:  product.id } }">{{ product.title }}</router-link></h3>
        <p>Price: {{ product.price }}$</p>
        <p>Category: {{ product.category }}</p>
        
        <span v-for="(color, i) in product.colors" :key="i">{{ color }}</span>
    </div>
</template>

<script>
export default {
    props: ['product']
}
</script>

<style scoped>
    .box {
        width: 31%;
        margin: 1%;
        background: rgb(244, 244, 244);
        padding: 20px;
        min-height: 250px;
        overflow: hidden;
        border-radius: 5px;
    }

    .box a {
        text-decoration: none;
        color: rgb(246, 42, 236);
    }

    .box span {
        font-size: 13px;
        padding: 2px 5px;
        background: rgb(212, 212, 212);
        margin: 0 2px;
        border-radius: 3px;
        text-transform: capitalize;
    }
</style>