<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router'

let props = defineProps({
    id: {
        type: String
    }
});

let router = useRouter();

let course = ref({
    id: '',
    title: '',
    image: '',
    description: '',
    price: '',
    discount: ''
});

onMounted(() => {
    getCourse();
})

const getCourse = () => {
  axios.get("/api/v1/courses/"+props.id)
  .then((res) => {
    course.value = res.data.data;
  });
};

const updateImage = (e) => {
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
        router.push('/')

        Toast.fire({
            icon: 'success',
            title: 'Course added successfully'
        })
    })
}

</script>
<template>
    <div class="container mt-5">

        <h1>Edit Course</h1>
        <form action="" @submit.prevent="addCourse">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" placeholder="Title" class="form-control" v-model="course.title" />
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
