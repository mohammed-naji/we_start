// const { createApp } = Vue;
Vue.createApp({
    data() {
        return {
            username: 'mahmoudabusafia',
            image: '',
            name: '',
            repos: []
        }
    },
    methods: {
        fetchData() {
            // alert(5)
            axios.get("https://api.github.com/users/"+this.username).then(res => {
                console.log(res.data);
                this.image = res.data.avatar_url
                this.name = res.data.name

                axios.get("https://api.github.com/users/"+this.username+'/repos').then(res => {
                    this.repos = res.data;
                    let arr = []
                    this.repos.forEach(el => {
                        let item = {
                            name: el.name,
                            url: el.html_url
                        }
                        arr.push(item)
                    })
                    // console.log(arr);
                    this.repos = arr;
                })
            }).catch(err => {
                this.image = ''
                this.name = ''
                this.repos = []
            })

            
            // console.log(this.username);
        }
    },
    mounted() {
        this.fetchData();
    }
}).mount('#app')