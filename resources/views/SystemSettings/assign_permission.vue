<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">System Settings</h2>
      <h4 class="stuLink">
        <router-link class="home" to="/Student">Home</router-link>/
        <router-link class="home" to="/role">Role Permissions</router-link>/ Assign Permissions
      </h4>
    </div>
    <hr />
    <div style="padding-left:2px;">
      <div class="card">
        <div class="card-header">
          <h6>Add Designation</h6>
        </div>
        <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
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
                <tr v-for="(val) in features">
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
        </div>
      </div>
      <button @click="save()" type="button" class="save">Save</button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      features: {},
      assign: {},
      errors: [],
      selectedMembers: [],
      addMore: false,
      guardianRelation: "",
      count: 0,
      pseudo: {}
    };
  },
  created() {
    this.findUser();
    this.axios.get("/api/features").then(response => {
      this.features = response.data;

      // console.log(JSON.stringify(this.features));
    });
  },
  methods: {
    findUser() {
      this.axios
        .get(`/api/assign/find/${this.$route.params.id}`)
        .then(response => {
          console.log("-->" + JSON.stringify(response));
          if (response.data == 0) {
            this.$router.push({ name: "role" });
          } else {
          }
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
      alert(this.$route.params.id);
      // this.axios.post(`/api/assign/store/${this.$route.param}`);
      console.log(JSON.stringify(this.features));
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

