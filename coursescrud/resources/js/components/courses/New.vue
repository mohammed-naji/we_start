<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from 'vue-router'

let router = useRouter();

let course = ref({
    title: '',
    image: '',
    description: '',
    price: '',
    discount: ''
});

let errors = ref([]);

const updateImage = (e) => {
    // console.log(e.target.files[0]);
    course.value.image = e.target.files[0]
}

const addCourse = () => {

    let formData = new FormData();
    formData.append('title', course.value.title)
    formData.append('image', course.value.image)
    formData.append('description', course.value.description)
    formData.append('price', course.value.price)
    formData.append('discount', course.value.discount)

    let config = {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    }

    axios.post('/api/v1/courses', formData, config)
    .then(res => {
        // console.log(res);

        router.push('/')

        Toast.fire({
            icon: 'success',
            title: 'Course added successfully'
        })
    })
    .catch(err => {
        // console.log(err.response.data.errors);
        errors.value = err.response.data.errors;
    })
}

</script>
<template>
    <div class="container mt-5">

        <!-- {{ errors }} -->
        <!-- {{ errors.title }} -->

        <div v-if="Object.keys( errors ).length > 0" class="alert alert-danger">

            <p v-for="(err, i) in errors" :key="i">
            {{ err[0] }}
            </p>

        </div>

        <h1>Add New Course</h1>
        <form action="" @submit.prevent="addCourse">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" placeholder="Title" class="form-control" :class="{ 'is-invalid' : errors.title }" v-model="course.title" />
            <span class="invalid-feedback" v-if="errors.title">{{ errors.title[0] }}</span>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" class="form-control" @change="updateImage" />
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea
            placeholder="Description"
            class="form-control"
            rows="5"
            v-model="course.description"
            ></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" placeholder="Price" class="form-control" v-model="course.price" />
        </div>

        <div class="mb-3">
            <label>Discount</label>
            <input type="number" placeholder="Discount" class="form-control" v-model="course.discount" />
        </div>

        <button class="btn btn-success px-4">Add</button>
        </form>
    </div>
</template>
