<template>
  <div class="vld-parent">
    <loading
      :active.sync="isLoading"
      :is-full-page="fullPage"
      :background-color="'#222'"
      :color="'#1b5e20'"
    ></loading>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import { EventBus } from "../js/event-bus.js";
export default {
  data() {
    return {
      isLoading: false,
      fullPage: true
    };
  },
  components: {
    Loading
  },
  mounted() {
    this.clickBus();
  },
  created() {
    this.clickBus();
  },
  methods: {
    clickBus() {
      EventBus.$on("clicked", response => {
        console.log("-->" + JSON.stringify(response));
        this.presentLoading();
      });
    },
    presentLoading() {
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
      }, 2000);
    }
  }
};
</script> 