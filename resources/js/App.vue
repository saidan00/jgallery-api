<template>
  <div id="app">
    <Navbar />
    <main class="py-4 container">
      <router-view />
    </main>
  </div>
</template>

<script>
import Navbar from "./components/incs/Navbar";
import Gallery from "./views/Gallery";
import { mapActions } from "vuex";

export default {
  name: "app",
  components: {
    Navbar,
    Gallery,
  },
  methods: {
    ...mapActions(["startLoading", "doneLoading"]),
  },
  created() {},
};
</script>

<style>
button::-moz-focus-inner {
  border: 0;
}
</style>