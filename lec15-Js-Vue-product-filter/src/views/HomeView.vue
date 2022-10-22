<template>
  <main>
    <section class="hero">
      <h1>Welcome to Our App</h1>
      <img src="@/assets/bg.jpg" alt="" />
    </section>
  </main>
</template>

<script>
import useUserStore from '../stores/store'

export default {
  data() {
    return {
      user: 'Mohammed Naji'
    }
  },
  mounted() {
    const globalname = useUserStore()
    globalname.UpdateUser('Aliiiiiiiiii');
    // console.log(globalname.age);
  }
}
</script>

<style scoped>

.hero {
  position: relative;
}

.hero img {
  height: 500px;
  width: 100%;
  object-fit: cover;
  display: block;
}


.hero:before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,.5);
  top: 0;
  left: 0;
}

.hero h1 {
  font-size: 60px;
  color: #fff;
  position: absolute;
  z-index: 9;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  margin: 0;
}
</style>