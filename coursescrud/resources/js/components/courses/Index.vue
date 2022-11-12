<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

let courses = ref([]);

onMounted(() => {
    getCourses();
})

const getCourses = () => {
    axios.get('/api/v1/courses')
    .then(res => {
        courses.value = res.data.data;
        // console.log(res.data.data);
    })
}

</script>
<template>
    <div>
        <h1>All Courses</h1>
        <h4 v-for="course in courses" :key="course.id">
        {{ course.title }}
        </h4>
    </div>
</template>
