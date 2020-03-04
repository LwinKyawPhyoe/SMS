<template>
  <div>
    <vue-ctk-date-time-picker
      :Enter="handleInput()"
      v-model="value"
      :only-date="true"
      :color="color"
      :button-color="color"
      :auto-close="true"
      :format="'YYYY-MM-DD'"
      :formatted="'YYYY/MM/DD'"
    >
      <input class="inputbox" v-model="value" autocomplete="off" />
    </vue-ctk-date-time-picker>
  </div>
</template>

<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";

export default {
  components: {
    VueCtkDateTimePicker
  },
  model: {
    event: `hand`
  },
  data() {
    return {
      value: "",
      color: ""
    };
  },
  created() {
    this.getTheme();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();
    today = yyyy + "-" + mm + "-" + dd;
    this.value = today;
  },
  mounted() {},
  methods: {
    getTheme() {
      this.axios.get("/api/color").then(response => {
        this.colors = response.data;
        for (var i = 0; i < this.colors.length; i++) {
          if (this.colors[i].color == "darkColor") {
            this.color = "#222";
          } else if (this.colors[i].color == "redColor") {
            this.color = "darkred";
          } else if (this.colors[i].color == "blueColor") {
            this.color = "darkcyan";
          } else if (this.colors[i].color == "defaultColor") {
            this.color = "#1b5e20";
          } else {
            this.color = "white";
          }
        }
      });
    },
    handleInput() {
      this.$emit("hand", this.value);
    }
  }
};
</script>
