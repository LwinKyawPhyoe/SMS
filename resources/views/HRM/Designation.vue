<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">HRM</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Designation
      </h4>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <Loading></Loading>
    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Designation</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" id="alertmsg" />

            <form @submit.prevent="addDesignation">
              <div class="col-12">
                <label for="name">
                  Name
                  <strong>*</strong>
                </label>
                <input
                  autocomplete="off"
                  id="name_id"
                  @keyup="onValidate(designation.designation_name, 'name_id', 'namemsg')"
                  v-on:blur="onValidate(designation.designation_name, 'name_id', 'namemsg')"
                  type="text"
                  class="inputbox"
                  v-model="designation.designation_name"
                />
                <span id="namemsg" class="error_message">Name is required</span>
              </div>
              <div class="col-12">
                <!--- store -->
                <button v-if="this.isEdit == false" type="submit" id="globalSave" class="save">Save</button>
                <button
                  v-else
                  @click="updateDesignation()"
                  type="button"
                  id="globalSave"
                  class="save"
                >Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-12" style="padding-left:0;">
        <div class="card">
          <div class="card-header">
            <h6>Designation List</h6>
          </div>
          <div class="card-body">
            <message :alertmessage="deletemsg" id="delalertmsg" />

            <input type="text" placeholder="Search..." class="searchText" />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a
                    href="#"
                    @click.prevent="downloadExcel('studenttable', 'name', 'Designation.xls')"
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
                  <div v-if="isEmpty == true" class="NoData">No Data</div>
                  <tr v-else v-for="(des) in designations" v-bind:key="des.id" class="active">
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
import message from "../Alertmessage/message.vue";
import { Util } from "../../js/util";
import Loading from "../LoadingController.vue";
export default {
  components: {
    confirm,
    Loading,
    message
  },
  data() {
    return {
      props: {
        url: "",
        type: ""
      },
      search: "",
      designation: {},
      designations: [],
      isEdit: false,
      isEmpty: false,
      delurl: "",
      msg: {
        text: "",
        type: ""
      },
      deletemsg: {
        text: "",
        type: ""
      }
    };
  },
  mounted() {
    this.getDesignations();
  },
  created() {
    EventBus.$emit("ThemeClicked");
    EventBus.$on("clicked", response => {
      this.getDesignations();
      (this.deletemsg.text = response.text),
        (this.deletemsg.type = response.type);
      Util.workAlert("#delalertmsg");
    });
    this.getDesignations();
  },
  methods: {
    getDesignations() {
      EventBus.$emit('onLoad');
      this.axios.get("/api/designations").then(response => {
        this.designations = response.data;
        if(this.designations.length > 0){
          this.isEmpty = false;
        }
        else{
          this.isEmpty = true;
        }
        EventBus.$emit('onLoadEnd');
      });
    },
    addDesignation() {
      console.log(JSON.stringify(this.designation));
      if (this.checkValidate()) {
        EventBus.$emit("onLoad");
        this.axios
          .post("/api/designation/store", this.designation)
          .then(response => {
            this.getDesignations();
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            EventBus.$emit("onLoadEnd");
            Util.scrollToTop();
            this.designation = {};
          })
          .catch(error => console.log(error));
      }
    },
    editDesignation(data) {
      console.log(JSON.stringify(data.name));
      Util.scrollToTop();
      this.designation = {};
      this.designation.id = data.id;
      this.designation.designation_name = data.designation_name;
      this.isEdit = true;
    },
    updateDesignation() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad");
        console.log(JSON.stringify(this.designation));
        this.axios
          .post(
            `/api/designation/update/${this.designation.id}`,
            this.designation
          )
          .then(response => {
            this.isEdit = false;
            this.designation = {};
            this.getDesignations();
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            EventBus.$emit("onLoadEnd");
            Util.scrollToTop();
            console.log(JSON.stringify(res));
          });
      }
    },
    deleteDesignation(id) {
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `designation/${funName}/${id}`;
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
      if (!this.designation.designation_name) {
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

    printme(table) {
      Util.printme(table);
    },

    downloadExcel(table, name, filename) {
      Util.downloadExcel(table, name, filename);
    }
  }
};
</script>