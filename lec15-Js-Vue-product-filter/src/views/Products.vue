<template>
    <div class="container">
        <section class="main-wrapper">
            <div class="side">
                <h3>Categories</h3>
                <label @change="filterProducts" v-for="(cat, i) in categories" :key="i"><input type="checkbox" v-model="selected_categories" :value="cat"> {{ cat }}</label>
                
{{ selected_categories }}
                <hr>

                <h3>Colors</h3>
                <label @change="filterProducts" v-for="(color, i) in colors" :key="i"><input type="checkbox" v-model="selected_colors" :value="color"> {{ color }}</label>
                
{{ selected_colors }}

                <hr>

                <h3>Price</h3>
                Min: <br>
                <input type="range">
                <br>
                Max: <br>
                <input type="range">
            </div>
            <div class="content">
                <product-item v-for="product in products" :key="product.id" :product="product" />
            </div>
        </section>
    </div>
</template>

<script>
import ProductItem from '../components/ProductItem.vue'
import products from '../data/products.json'

import useUserStore from '../stores/store'

export default {
    components: {ProductItem},
    data() {
        return {
            products,
            categories: ["Framing (Steel)", "EIFS", "Hard Tile & Stone", "Site Furnishings", "Soft Flooring and Base", "Sport"],
            colors: ["red", "blue", "pink", "black"],


            selected_categories: [],
            selected_colors: [],
            baseproducts: products
        }
    }, 
    mounted() {
        const globalstore = useUserStore()
        console.log(globalstore.showFullName);
    },
    methods:{
        filterProducts() {
            this.products = this.baseproducts

            let final = [...this.products]

            if(this.selected_categories.length > 0) {
                this.products = this.baseproducts.filter(p => this.selected_categories.includes(p.category))
            }

            // this.products = this.products.filter(p => p.colors.some(c => this.selected_colors.includes(c)))

            if(this.selected_colors.length > 0) {
                this.products = this.baseproducts.filter(p => p.colors.some(c => this.selected_colors.includes(c)))

                // if(this.selected_categories.length > 0) {
                //     this.products = this.products.filter(p => p.colors.some(c => this.selected_colors.includes(c)))
                // }else {
                //     this.products = this.baseproducts.filter(p => p.colors.some(c => this.selected_colors.includes(c)))
                // }
                
            }

            if(this.selected_colors.length > 0 && this.selected_categories.length > 0) {
                this.products = this.baseproducts.filter(p => p.colors.some(c => this.selected_colors.includes(c)))
            }
        }
    }
    // watch: {
    //     selected_categories: function() {
    //         if(this.selected_categories.length > 0) {
    //             this.products = this.baseproducts.filter(p => this.selected_categories.includes(p.category))
    //         }else {
    //             this.products = this.baseproducts
    //         }
    //     }, 

    //     selected_colors: function() {
    //         if(this.selected_colors.length > 0) {
    //             this.products = this.baseproducts.filter(p => this.selected_colors.includes(p.category))
    //         }else {
    //             this.products = this.baseproducts
    //         }
    //     }, 
    // }
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