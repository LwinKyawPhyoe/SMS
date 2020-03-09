<template>
  <div
    class="modal fade"
    id="exampleModalCenter"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
  <Loading></Loading>
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content" style="width:500px !important">
        <form @submit.prevent="yes">
          <div class="modal-header confirm-modal-header">
            <h6 class="modal-title" style="color: white;">Message</h6>
            <i data-dismiss="modal" class="fa fa-close confirm-q" aria-hidden="true"></i>
          </div>
          <div class="confirm-body">
            <h6 v-if="url.type != 'OK'" class="modal-title">Are you sure?</h6>
            <h6 v-if="url.type === 'OK'" class="modal-title">{{url.url}}</h6>
          </div>
          <div class="modal-footer confirm-modal-footer">
            <button v-if="url.type != 'OK'"
              id="globalSave"
              @click="yes()"
              type="submit"
              class="save"
              style="text-align:center;"
              data-dismiss="modal"
            >Yes</button>
            <button v-if="url.type != 'OK'" id="globalSave" type="button" class="confirmBtn-outline ripple" data-dismiss="modal">No</button>            
            <button v-if="url.type == 'OK'" type="button" class="confirmBtn-outline" data-dismiss="modal">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
import Loading from "../LoadingController.vue";
export default {
  components: {
        Loading
        },
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
      EventBus.$emit("onLoad");
      /***You can add More type */
      if (this.url.type == "confirm") {
        /**For check Confirm Box */
        let val = { disabled: "1", check: "true" };
        EventBus.$emit("clicked", val);
        EventBus.$emit("onLoadEnd");
      } else if (this.url.type == "delete") {
        /**For Delete Status */
        this.axios.delete(`/api/${this.url.url}`).then(response => {
          this.response = response.data;
          setTimeout(() => {
            EventBus.$emit("clicked", this.response);
          }, 100);
          EventBus.$emit("onLoadEnd");
        });
        EventBus.$emit("clicked", this.response);
      }else if(this.url.type == 'theinDelete'){
        this.axios.get(`api/${this.url.url}`).then(response=>{
          this.response = response.data;
          setTimeout(() => {
            EventBus.$emit("clicked", this.response);
          }, 100);
          EventBus.$emit("onLoadEnd");
        });
      }
    }
  }
};
</script>
