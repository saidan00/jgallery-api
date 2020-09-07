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
import { mapActions } from "vuex";

export default {
  name: "app",
  components: {
    Navbar,
  },
  methods: {
    ...mapActions(["startLoading", "doneLoading"]),
  },
};
</script>

<style>
button::-moz-focus-inner {
  border: 0;
}
</style>
