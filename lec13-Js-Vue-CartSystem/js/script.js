const { createApp } = Vue;

const products = [
    {
        name: "T-Shirt",
        price: 100
    },
    {
        name: "Laptop",
        price: 1000
    },
    {
        name: "Mouse",
        price: 50
    },
    {
        name: "Keyboard",
        price: 70
    }
];

let product = {
    props: ['name', 'price', 'index'],
    template: `
    <div class="box">
        <h3>{{ index }} {{ name }}</h3>
        <p>{{ price }}$ - {{ price * quantity }}$</p>
        <input type="number" min="1" v-model="quantity">
        <button @click="addToCart(index, quantity)">Add to Cart</button>
    </div>
    `,
    data() {
        return {
            quantity: 1
        }
    },
    methods: {
        addToCart(index, quantity) {
            this.$emit('add', index, quantity)
            this.quantity = 1
        }
    }
}

const app = createApp({
    components: {
        product
    },
    data() {
        return {
            products,
            carts: []
        }
    },
    methods: {
        addnewitem(index, quantity) {
            // Ajax request to add item in cart
            
            let item = {
                name: this.products[index].name,
                price: this.products[index].price,
                quantity: quantity
            }

            this.carts.push(item)
        },
        deleteitem(cart) {
            // Ajax Request to Delete item from Cart 

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                this.carts.splice(cart, 1);
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
            // if(confirm('Are you sure')) {
            //     this.carts.splice(cart, 1);
            // }
            
        }
    },
    computed: {
        cartTotal() {
            let total = 0;
            this.carts.forEach(el => {
                total += el.price * el.quantity
            });
            return total;
        }
    }
})

app.mount('#app')