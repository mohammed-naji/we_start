<template>
    <div class="container">
        <section class="main-wrapper">
            Single Product
            {{ product }}
        </section>
    </div>
</template>

<script>
import products from '../data/products.json'

export default {
    data() {
        return {
            product: []
        }
    },
    mounted() {
        this.product = products.filter(p => p.id == this.$route.params.id)
        // console.log(this.$route.params.id);
        // console.log(products);
    }
}
</script>

<style scoped>
.main-wrapper {
    display: flex;
    margin: 60px 0;
    flex-wrap: wrap;
}

.main-wrapper .side {
    width: 30%;
    padding: 0 20px;
}
.main-wrapper .content {
    width: 70%;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
}

.side label {
    display: block;
}
</style>