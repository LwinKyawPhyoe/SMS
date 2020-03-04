<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Hostel</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>>Hostel
      </h4>
    </div>
    <hr />
    <Loading></Loading>
    <confirm :url="props"></confirm>
    <div class="row" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Hostel</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <form action>
              <message :alertmessage="msg" id="alertmsg" />
              <div class="col-12">
                <label for="hostel_name">
                  Hostel Name
                  <strong>*</strong>
                </label>
                <input
                  autocomplete="off"
                  type="text"
                  class="inputbox"
                  v-model="hostel.hostel_name"
                  id="sectionid"
                  @keyup="onValidate(hostel.hostel_name, 'sectionid', 'sectionmsg')"
                  v-on:blur="onValidate(hostel.hostel_name, 'sectionid', 'sectionmsg')"
                />
                <span id="sectionmsg" class="error_message">Hostel Name is required</span>
              </div>
              <div class="col-12">
                <label for="type">
                  Type
                  <strong>*</strong>
                </label>
                <select
                  id="typeid"
                  v-model="hostel.type"
                  @keyup="onValidate(hostel.type, 'typeid', 'typemsg')"
                  v-on:blur="onValidate(hostel.type, 'typeid', 'typemsg')"
                  class="inputbox"
                >
                  <option selected disabled>Select</option>
                  <option value="Boys">Boys</option>
                  <option value="Girls">Girls</option>
                  <option value="Combine">Combine</option>
                </select>
                <span id="typemsg" class="error_message">Type is required</span>
              </div>
              <div class="col-12">
                <label for="address">Address</label>
                <input autocomplete="off" type="text" class="inputbox" v-model="hostel.address" />
              </div>
              <div class="col-12">
                <label for="intake">Intake</label>
                <input autocomplete="off" type="number" class="inputbox" v-model="hostel.intake" />
              </div>
              <div class="col-12 end">
                <label for="description">Description</label>
                <textarea
                  autocomplete="off"
                  class="textareas"
                  v-model="hostel.description"
                  rows="3"
                ></textarea>
              </div>
              <div class="col-12">
                <!--- store -->
                <button
                  id="globalSave"
                  v-if="this.isEdit == false"
                  @click="addHostel()"
                  type="button"
                  class="save"
                >Save</button>
                <button
                  id="globalSave"
                  v-else
                  @click="updateHostel()"
                  type="button"
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
            <h6>Hostel List</h6>
          </div>
          <div class="card-body">
            <message :alertmessage="deletemsg" id="delalertmsg" />
            <input
              v-model="search"
              @input="searchData()"
              type="text"
              placeholder="Search..."
              class="searchText"
            />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a
                    href="#"
                    @click.prevent="downloadExcel('studenttable', 'name', 'Hostel.xls')"
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
                    <th class="all" nowrap>
                      Hostel Name
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </th>
                    <th class="all" nowrap>
                      Type
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </th>
                    <th class="all" nowrap>
                      Address
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </th>
                    <th class="all" nowrap>
                      Intake
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </th>
                    <th class="all" nowrap>
                      Action
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <div v-if="isEmpty == true" class="NoData">No Data</div>
                  <tr v-else v-for="(hos) in hostels" v-bind:key="hos.id" class="active">
                    <td class="all" nowrap>
                      <p class="toolText">
                        {{hos.hostel_name}}
                        <span
                          v-if="hos.description"
                          class="tooltipLabel"
                        >{{hos.description}}</span>
                        <span v-else class="tooltipLabel text-danger">No Description</span>
                      </p>
                    </td>
                    <td class="all" nowrap>{{hos.type}}</td>
                    <td class="all" nowrap>{{hos.address}}</td>
                    <td class="all" nowrap>{{hos.intake}}</td>
                    <td>
                      <i @click="editHostel(hos)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <!-- @click=" deleteHostel(hos.id)" -->
                      <i
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        class="fa fa-trash time"
                        data-id="hos"
                        @click="deleteHostel(hos.id)"
                      >
                        <span class="timeLabel">Delete</span>
                      </i>
                    </td>
                  </tr>
                  <td style="text-align : center;" colspan="5" v-if="noMatch == true">
                    <span class="text-danger">No matching records found</span>
                  </td>
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
import message from "../Alertmessage/message.vue";
import { Util } from "../../js/util";
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js";
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
      hostel: {},
      search: "",
      hostels: [],
      url: "",
      id: "",
      isEdit: false,
      isEmpty: false,
      noMatch: false,
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
    EventBus.$emit("onLoad");
    this.getHostels();
  },
  created() {
    EventBus.$emit("ThemeClicked");
    EventBus.$on("clicked", response => {
      (this.deletemsg.text = response.text),
        (this.deletemsg.type = response.type);
      Util.workAlert("#delalertmsg");
      this.getHostels();
    });
    this.getHostels();
  },
  methods: {
    /**
     * GET DATA
     */
    getHostels() {
      this.axios.get("/api/hostels").then(response => {
        this.hostels = response.data;
        if(this.hostels.length > 0){
          this.isEmpty = false;
        }
        else{
          this.isEmpty = true;
        }
        EventBus.$emit("onLoadEnd");
      });
    },
    /**
     * STORE DATA
     */
    addHostel() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad", "1");
        console.log("-->" + JSON.stringify(this.hostel));
        this.axios
          .post("/api/hostel/store", this.hostel)
          .then(response => {
            this.getHostels();
            this.hostel = {};
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            EventBus.$emit("onLoadEnd");
            Util.scrollToTop();
          })
          .catch(error => console.log(error));
      }
    },
    /**
     * EDIT SHOW DATA
     */
    editHostel(hos) {
      Util.scrollToTop();
      this.moveToDown = !this.moveToDown;
      this.hostel = {};
      this.moveToDown = !this.moveToDown;
      this.hostel.id = hos.id;
      this.hostel.hostel_name = hos.hostel_name;
      this.hostel.type = hos.type;
      this.hostel.address = hos.address;
      this.hostel.intake = hos.intake;
      this.hostel.description = hos.description;
      this.isEdit = true;
    },
    /**
     * UPDATE
     */
    updateHostel() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad", "1");
        this.axios
          .post(`/api/hostel/update/${this.hostel.id}`, this.hostel)
          .then(response => {
            this.getHostels();
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            this.isEdit = false;
            this.hostel = "";
            EventBus.$emit("onLoadEnd");
            Util.scrollToTop();
            console.log(JSON.stringify(response));
          });
      }
    },
    deleteHostel(id) {
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `hostel/${funName}/${id}`;
    },
    /**
     * SEARCH
     */
    searchData() {
      if (this.search == "") {
        this.axios.get(`api/hostels`).then(response => {
          this.hostels = [];
          this.noMatch = false;
          this.hostels = response.data;
        });
      } else {
        this.axios.get(`api/hostel/search/${this.search}`).then(response => {
          console.log(JSON.stringify(response.data));
          this.hostels = [];
          this.hostels = response.data;
          if (this.hostels == "") {
            this.noMatch = true;
          } else {
            this.noMatch = false;
          }
        });
      }
    },
    /***
     * FORM VALIDATION
     */
    onValidate(value, inputId, megId) {
      Util.onValidate(value, inputId, megId);
    },

    checkValidate() {
      if (!this.hostel.hostel_name) {
        Util.onValidateMessage("sectionid", "sectionmsg");
        return false;
      } else if (!this.hostel.type) {
        Util.onValidateMessage("typeid", "typemsg");
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