<template>
  <div id="app">
    <Navbar />
    <div class="container">
      <Gallery />
    </div>
  </div>
</template>

<script>
import Navbar from "./components/incs/Navbar";
import Gallery from "./views/Gallery";

export default {
  name: "app",
  components: {
    Navbar,
    Gallery,
  },
};
</script>

<style scoped>
</style>