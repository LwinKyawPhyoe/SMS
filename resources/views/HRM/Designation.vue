<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">HRM</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Designation
      </h4>
    </div>
    <hr />
    <confirm :url="delurl"></confirm>
    <div class="row rowContainer" style="align-items: end !important;margin:0;">
      <div class="col-lg-5 col-md-12" style="padding:0px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Designation</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <form @submit.prevent="addDesignation">
              <div class="col-12">
                <label for="name">
                  Name
                  <strong>*</strong>
                </label>
                <input
                  id="name_id"
                  @keyup="onValidate(designation.designation_name, 'name_id', 'namemsg')"
                  v-on:blur="onValidate(designation.designation_name, 'name_id', 'namemsg')"
                  type="text"
                  class="inputbox"
                  v-model="designation.designation_name"
                />
                <span id="namemsg" class="error_message">Name is required</span>
              </div>
              <div class="col-12 column-12">
                <!--- store -->
                <button v-if="this.isEdit == false" id="globalSave" type="submit" class="save">Save</button>
                <button
                  v-else
                  @click="updateDesignation()"
                  id="globalSave"
                  type="button"
                  class="save"
                >Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-7 col-md-12" style="padding:0;">
        <div class="card">
          <div class="card-header">
            <h6>Designation List</h6>
          </div>
          <div class="card-body">
            <input type="text" placeholder="Search..." class="searchText" />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a href="#" title="Excel">
                    <i class="fa fa-file-excel-o"></i>
                  </a>
                </div>
                <div class="col-3">
                  <a href="#" title="Print">
                    <i class="fa fa-print"></i>
                  </a>
                </div>
                <div class="col-3">
                  <a href="#" title="Columns">
                    <i class="fa fa-columns"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-striped" id="studenttable">
                <thead>
                  <tr>
                    <th class="all" nowrap>Name</th>
                    <th class="all" nowrap style="text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(des) in designations" v-bind:key="des.id" class="active">
                    <td class="all" nowrap>{{des.designation_name}}</td>
                    <td style="text-align: right;">
                      <i @click="editDesignation(des)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        @click="deleteDesignation(des.id)"
                        class="fa fa-trash time"
                      >
                        <span class="timeLabel">Delete</span>
                      </i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/**
 *  COMPONENTS
 */
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js";
export default {
  components: {
    confirm
  },
  data() {
    return {
      search: "",
      designation: {},
      designations: [],
      isEdit: false,
      delurl: ""
    };
  },
  mounted() {
    this.getDesignations();
  },
  created() {
    EventBus.$emit("clicked");
    EventBus.$on("clicked", response => {
      this.getDesignations();
    });
    this.getDesignations();
  },
  methods: {
    getDesignations() {
      this.axios
        .get("/api/designations")
        .then(response => (this.designations = response.data));
    },
    addDesignation() {
      console.log(JSON.stringify(this.designation));
      if (this.checkValidate()) {
        this.axios
          .post("/api/designation/store", this.designation)
          .then(response => {
            this.getDesignations();
            setTimeout(() => {
              this.designation = {};
            }, 100);
          })
          .catch(error => console.log(error));
      }
    },
    editDesignation(data) {
      console.log(JSON.stringify(data.name));
      let to = this.moveToDown ? this.$refs.description.offsetTop - 60 : 0;
      window.scroll({
        top: to,
        left: 0,
        behavior: "smooth"
      });
      this.moveToDown = !this.moveToDown;
      this.designation = {};
      this.moveToDown = !this.moveToDown;
      this.designation.id = data.id;
      this.designation.designation_name = data.designation_name;
      this.isEdit = true;
    },
    updateDesignation() {
      console.log(JSON.stringify(this.designation));
      this.axios
        .post(
          `/api/designation/update/${this.designation.id}`,
          this.designation
        )
        .then(res => {
          this.isEdit = false;
          this.designation = {};
          this.getDesignations();
          console.log(JSON.stringify(res));
        });
    },
    deleteDesignation(id) {
      var funName = "delete"; /**Delete function */
      this.delurl = `designation/${funName}/${id}`;
    },
    searchData() {
      if (this.search == "") {
        this.axios.get(`api/departments`).then(response => {
          this.roomtypes = [];
          this.roomtypes = response.data;
        });
      } else {
        this.axios
          .get(`api/department/search`, { params: { keywords: this.search } })
          .then(response => {
            this.roomtypes = [];
            this.roomtypes = response.data;
          });
      }
    },
    /***
     * FORM VALIDATIOn
     */
    onValidate(value, inputId, megId) {
      if (value == "" || value == undefined)
        document.getElementById(inputId).style.border = "solid 1px red";
      else {
        document.getElementById(inputId).style.border = "solid 1px #d2d6de";
        document.getElementById(megId).style.display = "none";
      }
    },
    onValidateMessage(inputId, megId) {
      document.getElementById(inputId).style.border = "solid 1px red";
      document.getElementById(megId).style.display = "block";
    },
    checkValidate() {
      if (!this.designation.designation_name) {
        this.onValidateMessage("name_id", "namemsg");
        return false;
      } else {
        return true;
      }
      return false;
    },
    goAlertClose() {
      $(".alert").css("display", "none");
    }
  }
};
</script>