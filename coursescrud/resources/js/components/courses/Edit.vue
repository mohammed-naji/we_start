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

let imagesrc = ref();

onMounted(() => {
    getCourse();
})

const getCourse = () => {
  axios.get("/api/v1/courses/"+props.id)
  .then((res) => {
    course.value = res.data.data;
    imagesrc.value = '/uploads/' + res.data.data.image;
  });
};

const updateImage = (e) => {
    course.value.image = e.target.files[0]

    if (e.target.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        imagesrc.value = e.target.result;
    };

    reader.readAsDataURL(e.target.files[0]);
  }
}

const updateCourse = () => {

    let formData = new FormData();
    formData.append('title', course.value.title)
    formData.append('image', course.value.image)
    formData.append('description', course.value.description)
    formData.append('price', course.value.price)
    formData.append('discount', course.value.discount)
    formData.append('_method', 'put')

    let config = {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    }

    axios.post('/api/v1/courses/'+course.value.id, formData, config)
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
        <form action="" @submit.prevent="updateCourse">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" placeholder="Title" class="form-control" v-model="course.title" />
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" class="form-control" @change="updateImage" />
            <img width="100" :src="imagesrc" alt="">
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

        <button class="btn btn-success px-4">Update</button>
        </form>
    </div>
</template>
