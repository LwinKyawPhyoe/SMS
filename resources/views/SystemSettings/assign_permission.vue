<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">System Settings</h2>
      <h4 class="stuLink">
        <router-link class="home" to="/Student">Home</router-link>>
        <router-link class="home" to="/role">Role Permissions</router-link>> Assign Permissions
      </h4>
    </div>
    <hr />
    <Loading></Loading>
    <div style="padding-left:2px;">
      <div class="card">
        <div class="card-header">
          <h6>
            Assign Permission
            <span>  ({{role_name}})</span>
          </h6>
        </div>
        <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
          <message :alertmessage="msg" id="alertmsg" />
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Module</th>
                  <th scope="col">Feature</th>
                  <th scope="col">View</th>
                  <th scope="col">Add</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(val ,i ) in features" :key="i">
                  <td v-html="val.module"></td>
                  <td>{{val.feature}}</td>
                  <td>
                    <input v-if="val.can_view != false" type="checkbox" v-model="val.view" />
                  </td>
                  <td>
                    <input v-if="val.can_add != false" type="checkbox" v-model="val.add" />
                  </td>
                  <td>
                    <input
                      v-if="val.can_edit != false"
                      type="checkbox"
                      value="1"
                      v-model="val.edit"
                    />
                  </td>
                  <td>
                    <input
                      v-if="val.can_delete != false"
                      type="checkbox"
                      value="1"
                      v-model="val.delete"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <button
            style="margin-right: 10px;"
            @click="save()"
            type="button"
            class="save"
            id="globalSave"
          >Save</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
/***Components */
import Loading from "../LoadingController.vue";
import { EventBus } from "../../js/event-bus.js";
import { Util } from "../../js/util";
import message from "../Alertmessage/message.vue";

export default {
  components: {
    Loading,
    message
  },
  data() {
    return {
      features: {},
      assign: {},
      errors: [],
      selectedMembers: [],
      permissions: { ary: [] },
      currentUserPermissions: [],
      addMore: false,
      guardianRelation: "",
      role_name: "",
      count: 0,
      pseudo: {},
      msg: {
        text: "",
        type: ""
      }
    };
  },
  mounted() {
    EventBus.$emit("onLoad");
  },
  created() {
    EventBus.$emit("ThemeClicked");
    this.getUserPermission();
    this.findUser();
    this.findRoleName();
  },
  methods: {
    getUserPermission() {
      this.axios
        .get(
          `/api/assign/show/${this.$route.params.id}`
        ) /** From DB For Permissions */
        .then(response => {
          this.currentUserPermissions = response.data;
          console.log("current user permi" + JSON.stringify(response.data));
        });
      this.axios.get("/api/features").then(response => {
        /** List For Permissions Features */
        this.features = response.data;
        for (var i = 0; i < this.features.length; i++) {
          console.log("Permission" + JSON.stringify(this.features[i]));
          for (var ii = 0; ii < this.currentUserPermissions.length; ii++) {
            console.log("" + this.currentUserPermissions[ii].can_view);
            if (
              this.currentUserPermissions[ii].feature ==
              this.features[i].feature
            ) {
              this.features[i].view = this.currentUserPermissions[ii].can_view;
              this.features[i].add = this.currentUserPermissions[ii].can_add;
              this.features[i].edit = this.currentUserPermissions[ii].can_edit;
              this.features[i].delete = this.currentUserPermissions[
                ii
              ].can_delete;
              break;
            }
          }
          EventBus.$emit("onLoadEnd");
        }
      });
    },
    findUser() {
      this.axios
        .get(`/api/assign/find/${this.$route.params.id}`)
        .then(response => {
          console.log("-->" + JSON.stringify(response.data));
          var name = response.data.name;
          for (var i = 0; i < i < name.length; i++) {
            this.role_name = name[i].name;
          }
          if (response.data.count == 0) {
            this.$router.push({ name: "role" });
          } else {
          }
        });
    },
    findRoleName() {
      this.axios
        .get(`/api/assign/findrole/${this.$route.params.id}`)
        .then(response => {
          alert(this.response.data);

          this.role_name = this.response.data;
        });
    },
    say(id, feature, checked, type) {
      alert(this.$route.param);
      if (checked != true) {
        alert("checked");
      } else {
        alert("");
      }
      console.log(
        "Id ==>",
        id +
          "===>" +
          "Feature ==>" +
          feature +
          "," +
          "Checked ==>" +
          checked +
          "," +
          "Type == > " +
          type
      );
      console.log("Features==>" + JSON.stringify(this.features));
    },
    openClose() {
      if (this.addMore == false) {
        this.addMore = true;
        document.getElementById("footer").style.marginTop = "0";
        document.getElementById("smBar").style.height = "311vh";
      } else {
        this.addMore = false;
        document.getElementById("footer").style.marginTop = "10px";
        document.getElementById("smBar").style.height = "201vh";
      }
      console.log(this.addMore);
    },
    save() {
      EventBus.$emit("onLoad");
      for (var i = 0; i < this.features.length; i++) {
        this.permissions.ary.push({
          role_id: this.$route.params.id,
          id: this.features[i].id,
          feature: this.features[i].feature,
          view: this.features[i].view,
          add: this.features[i].add,
          edit: this.features[i].edit,
          delete: this.features[i].delete
        });
      }

      this.axios
        .post(`/api/assign/store/${this.$route.params.id}`, this.permissions)
        .then(response => {
          EventBus.$emit("onLoadEnd");
          Util.scrollToTop();
          this.msg.text = response.data.text;
          this.msg.type = response.data.type;
          Util.workAlert("#alertmsg");
        });
      console.log(JSON.stringify(this.permissions.ary));
    },
    checkGuardian(type) {
      if (type == "other") {
        this.guardianRelation = "";
      } else if (type == "mother") {
        this.guardianRelation = "Mother";
      } else if (type == "father") {
        this.guardianRelation = "Father";
      }
    }
  }
};
</script>

