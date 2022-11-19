<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router'
import { Bootstrap5Pagination } from 'laravel-vue-pagination';


let router = useRouter();

let courses = ref([]);

onMounted(() => {
  getCourses();
});

const getCourses = (page = 1) => {
  axios.get("/api/v1/courses?page="+page)
  .then((res) => {
    courses.value = res.data.data;
    console.log(res.data.data);
  });
};

const addNew = () => {
    router.push('/course/new')
}

const deleteCourse = (id) => {
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
        axios.delete("/api/v1/courses/"+id)
        .then((res) => {
            Toast.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            getCourses();
        });
    }
})


}

const editCourse = (id) => {
    router.push(`/course/${id}/edit`)
}
</script>
<template>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>All Courses</h1>
        <button class="btn btn-success" @click="addNew">Add New Course</button>
    </div>
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Image</th>
          <th>Price</th>
          <th>Discount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="course in courses.data" :key="course.id">
          <td>{{ course.id }}</td>
          <td>{{ course.title }}</td>
          <td><img width="100" :src="'uploads/'+course.image" alt=""></td>
          <td>{{ course.price }}</td>
          <td>{{ course.discount }}</td>
          <td>
            <button class="btn btn-sm btn-primary" @click="editCourse(course.id)">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger" @click="deleteCourse(course.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <Bootstrap5Pagination
        :data="courses"
        @pagination-change-page="getCourses"
    />
  </div>
</template>

<style scoped>
.table th,
.table td {
    vertical-align: middle;
}
</style>
