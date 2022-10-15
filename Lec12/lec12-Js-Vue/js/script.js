const { createApp } = Vue;

let persons = [
    {name: "Mohammed Ahmed", age: 20},
    {name: "Ali Ahmed", age: 22},
    {name: "Ezz Ahmed", age: 25},
    {name: "Issa Mohammed", age: 30},
]

const app1 = createApp({
    data() {
        return {
            name: 'Mohammed Naji',
            desc: 'Lorem ipsum dolor sit amet.',
            content: '<p>this is new <span>content</span></p>',
            persons,
            isDark: false,
            posts: []
        }
    },
    methods: {
        darkMood() {
            this.isDark = !this.isDark
        },

        loadData() {
            axios.get('https://jsonplaceholder.typicode.com/posts')
            .then(function(res) {
                this.posts = res.data
            })
        }
    },
    mounted () {
        axios.get('https://jsonplaceholder.typicode.com/posts').then(res => this.posts = res.data)
      }
});

app1.mount('.app1')


// const app2 = createApp({
//     data() {
//         return {
//             name: 'Mohammed Ali',
//             desc: 'Lorem ipsum dolor sit amet.'
//         }
//     }
// });

// app2.mount('.app2')

// let app = new Vue({
//     el: '#app'
// })