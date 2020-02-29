<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">HRM</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Department
      </h4>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <Loading></Loading>
    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Department</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <form @submit.prevent="addDepartment">
              <message :alertmessage="msg" />
              <div class="col-12">
                <label for="name">
                  Name
                  <strong>*</strong>
                </label>
                <input
                  id="sessionid"
                  type="text"
                  class="inputbox"
                  v-model="department.department_name"
                  @keyup="onValidate(department.department_name, 'sessionid', 'sessionmsg')"
                  v-on:blur="onValidate(department.department_name, 'sessionid', 'sessionmsg')"
                />
                <span id="sessionmsg" class="error_message">Name is required</span>
              </div>
              <div class="col-12">
                <!--- store -->
                <button v-if="this.isEdit == false" type="submit" class="save">Save</button>
                <button v-else @click="updateDepartment()" type="button" class="save">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-7 col-md-12" style="padding-left:0;">
        <div class="card">
          <div class="card-header">
            <h6>Department List</h6>
          </div>
          <div class="card-body">
            <input type="text" placeholder="Search..." class="searchText" />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a
                    href="#"
                    @click.prevent="downloadExcel('studenttable', 'name', 'Department.xls')"
                    title="Excel"
                  >
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
                    <th class="all" nowrap style="text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(des) in departments" v-bind:key="des.id" class="active">
                    <td class="all" nowrap>{{des.department_name}}</td>
                    <td style="text-align: right;">
                      <i @click="editDepartment(des)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        @click="deleteDepartment(des.id)"
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
import { Util } from "../../js/util";
import Loading from "../LoadingController.vue";

export default {
  components: {
    confirm,
    message,
    Loading
  },
  data() {
    return {
      props: {
        url: "",
        type: ""
      },
      search: "",
      department: {},
      departments: [],
      isEdit: false,
      delurl: "",
      msg: {
        text: "",
        type: ""
      }
    };
  },
  mounted() {
    this.getDepartments();
  },
  created() {
    EventBus.$on("clicked", response => {
      this.getDepartments();
      (this.msg.text = response.text), (this.msg.type = response.type);
    });
    this.getDepartments();
  },
  methods: {
    getDepartments() {
      this.axios
        .get("/api/departments")
        .then(response => (this.departments = response.data));
    },
    addDepartment() {
      console.log(JSON.stringify(this.department));
      if (this.checkValidate()) {
        EventBus.$emit("onLoad", "1");
        this.axios
          .post("/api/department/store", this.department)
          .then(response => {
            this.getDepartments();
            setTimeout(() => {
              this.department = {};
              (this.msg.text = response.data.text),
                (this.msg.type = response.data.type);
            }, 100);
          })
          .catch(error => console.log(error));
      }
    },
    editDepartment(data) {
      console.log(JSON.stringify(data.department_name));
      let to = this.moveToDown ? this.$refs.description.offsetTop - 60 : 0;
      window.scroll({
        top: to,
        left: 0,
        behavior: "smooth"
      });
      this.department = {};
      this.department.id = data.id;
      this.department.department_name = data.department_name;
      this.isEdit = true;
    },
    updateDepartment() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad", "1");
        this.axios
          .post(`/api/department/update/${this.department.id}`, this.department)
          .then(response => {
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            setTimeout(() => {
              this.getDepartments();
              console.log("Response text ==> " + response.data.text);
              this.isEdit = false;
              this.department = {};
            }, 100);
          });
      }
    },
    deleteDepartment(id) {
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `department/${funName}/${id}`;
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
     *
     * Form Validation
     *
     */
    onValidate(value, inputId, megId) {
      Util.onValidate(value, inputId, megId);
    },

    checkValidate() {
      if (
        this.department.department_name == "" ||
        this.department.department_name == undefined
      ) {
        Util.onValidateMessage("sessionid", "sessionmsg");
      } else {
        return true;
      }
      return false;
    },

    printme(table) {
      Util.printme(table);
    },

    downloadExcel(table, name, filename) {
      Util.downloadExcel(table, name, filename);
    }
  }
};
</script>