<template>
    <div>
        <article v-for="(post, index) in posts" :key="index">
            <h2>{{ post.title }}</h2>
            <p>{{ post.body }}</p>
        </article>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            posts: []
        }
    },

    mounted() {
        axios.get('https://jsonplaceholder.typicode.com/posts').then((res) => {
            this.posts = res.data
        })
    }
}
</script>

<style scoped>

</style>