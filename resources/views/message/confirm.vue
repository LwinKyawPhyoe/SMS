<template>
  <div
    class="modal fade"
    id="exampleModalCenter"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <form @submit.prevent="deleteData">
          <div class="modal-header confirm-modal-header">
            <h6 class="modal-title" style="color: white;">Message</h6>
            <i data-dismiss="modal" class="fa fa-close confirm-q" aria-hidden="true"></i>
          </div>
          <div class="confirm-body">
            <h6 class="modal-title">Are you sure?</h6>
          </div>
          <div class="modal-footer confirm-modal-footer">
            <button
              @click="yes()"
              type="submit"
              class="confirmBtn"
              style="text-align:center;"
              data-dismiss="modal"
            >Yes</button>
            <button type="button" class="confirmBtn-outline" data-dismiss="modal">No</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
export default {
  props: {
    params: {
      url: "",
      type: ""
    },
    url: "",
    type: ""
  },
  data() {
    return {
      response: [
        {
          text: ""
        },
        {
          type: ""
        }
      ]
    };
  },
  methods: {
    yes() {
      /***You can add More type */
      if (this.url.type == "confirm") {
        /**For Simple Confirm Box */
        let val = { disabled: "1", check: "true" };
        EventBus.$emit("clicked", val);
        alert("confirm");
      } else if (this.url.type == "delete") {
        alert("delete");
        /**For Delete Status */
        this.axios.delete(`/api/${this.url.url}`).then(response => {
          this.response = response.data;
          console.log("" + JSON.stringify(response.data));
          setTimeout(() => {
            EventBus.$emit("clicked", this.response);
          }, 100);
        });
        EventBus.$emit("clicked", this.response);
      }
    }
  }
};
</script>
