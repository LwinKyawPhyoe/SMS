<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">System Settings</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Role Permissions
      </h4>
    </div>
    <hr />
    <confirm :url="delurl"></confirm>
    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Role</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <form @submit.prevent="addRole">
              <div class="col-12">
                <label for="name">
                  Name
                  <strong>*</strong>
                </label>
                <input
                  id="name_id"
                  type="text"
                  class="inputbox"
                  v-model="model.name"
                  @keyup="onValidate(model.name, 'name_id', 'namemsg')"
                  v-on:blur="onValidate(model.name, 'name_id', 'namemsg')"
                />
                <span id="namemsg" class="error_message">Name is required</span>
              </div>
              <div class="col-12">
                <!--- store -->
                <button v-if="this.isEdit == false" type="submit" id="globalSave" class="save">Save</button>
                <button v-else @click="updateRole()" type="button" id="globalSave" class="save">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-12" style="padding-left:0;">
        <div class="card">
          <div class="card-header">
            <h6>Role List</h6>
          </div>
          <div class="card-body">
            <input type="text" placeholder="Search..." class="searchText" />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Role.xls')" title="Excel">
                    <i class="fa fa-file-excel-o"></i>
                  </a>
                </div>
                <div class="col-3">
                  <a href="#" @click.prevent="printme('print')" title="Print">
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

            <div class="table-responsive" id="print">
              <table class="table table-hover table-striped" id="studenttable">
                <thead>
                  <tr>
                    <th class="all" nowrap>Name</th>
                    <th class="all" nowrap>Type</th>
                    <th class="all" nowrap style="text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(rol) in roles" v-bind:key="rol.id" class="active">
                    <td class="all" nowrap>{{rol.name}}</td>
                    <td class="all" nowrap>{{rol.type}}</td>

                    <td style="text-align: right;">
                      <router-link to="role/assign">
                        <i class="fa fa-tag assign" aria-hidden="true">
                          <span class="assignLbl">Assign Permission</span>
                        </i>
                      </router-link>
                      <i @click="editRole(rol)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i
                        v-if="checkDelete == true"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        @click="deleteRole(rol.id)"
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
import message from "../Alertmessage/message.vue";
import {Util} from '../../js/util';

export default {
  components: {
    confirm
  },
  data() {
    return {
      search: "",
      model: {},
      roles: [],
      isEdit: false,
      checkDelete: false,
      delurl: ""
    };
  },
  mounted() {
    this.getRoles();
  },
  created() {
    EventBus.$on("clicked", clickCount => {
      this.getRoles();
    });
    this.getRoles();
  },
  methods: {
    getRoles() {
      this.axios
        .get("/api/roles")
        .then(response => (this.roles = response.data));
    },
    addRole() {
      console.log(JSON.stringify(this.model));
      if (this.checkValidate()) {
        this.axios
          .post("/api/role/store", this.model)
          .then(response => {
            this.getRoles();
            setTimeout(() => {
              this.model = {};
            }, 100);
          })
          .catch(error => console.log(error));
      }
    },
    editRole(data) {
      console.log(JSON.stringify(data.name));
      let to = this.moveToDown ? this.$refs.description.offsetTop - 60 : 0;
      window.scroll({
        top: to,
        left: 0,
        behavior: "smooth"
      });
      this.moveToDown = !this.moveToDown;
      this.model = {};
      this.moveToDown = !this.moveToDown;
      this.model.id = data.id;
      this.model.name = data.name;
      this.isEdit = true;
      this.checkDelete = true;
    },
    updateRole() {
      console.log(JSON.stringify(this.model));
      this.axios
        .post(`/api/role/update/${this.model.id}`, this.model)
        .then(res => {
          this.isEdit = false;
          this.checkDelete = false;
          this.model = {};
          this.getRoles();
          console.log(JSON.stringify(res));
        });
    },
    deleteRole(id) {
      var funName = "delete"; /**Delete function */
      this.delurl = `role/${funName}/${id}`;
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
      Util.onValidate(value, inputId, megId);
    },
    
    checkValidate() {
      if (!this.model.name) {
        Util.onValidateMessage("name_id", "namemsg");
        return false;
      } else {
        return true;
      }
      return false;
    },
    goAlertClose() {
      $(".alert").css("display", "none");
    },

    printme(table)
    {
      Util.printme(table);
    },

    downloadExcel(table, name, filename) 
    {
      Util.downloadExcel(table,name,filename);
    }
  }
};
</script>