<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container">
        <router-link class="navbar-brand" to="/">Courses CRUD</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" to="/">All Courses</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/course/new">Add New</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>
