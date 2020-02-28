<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Hostel</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>>Hostel
      </h4>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <div class="row" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Hostel</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <form action>
              <message :alertmessage="msg" />
              <div class="col-12">
                <label for="hostel_name">
                  Hostel Name
                  <strong>*</strong>
                </label>
                <input
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
                <input type="text" class="inputbox" v-model="hostel.address" />
              </div>
              <div class="col-12">
                <label for="intake">Intake</label>
                <input type="text" class="inputbox" v-model="hostel.intake" />
              </div>
              <div class="col-12 end">
                <label for="description">Description</label>
                <textarea class="textareas" v-model="hostel.description" rows="3"></textarea>
              </div>
              <div class="col-12">
                <!--- store -->
                <button
                  v-if="this.isEdit == false"
                  @click="addHostel()"
                  type="button"
                  class="save"
                >Save</button>
                <button v-else @click="updateHostel()" type="button" class="save">Save</button>
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
                  <tr v-for="(hos) in hostels" v-bind:key="hos.id" class="active">
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
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js";

export default {
  components: {
    confirm,
    message
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
      noMatch: false,

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
    this.getHostels();
  },
  created() {
    EventBus.$on("clicked", clickCount => {
      this.getHostels();
    });
    this.axios
      .get("/api/hostels")
      .then(response => (this.hostels = response.data));
  },
  methods: {
    /**
     * GET DATA
     */
    getHostels() {
      this.axios
        .get("/api/hostels")
        .then(response => (this.hostels = response.data));
    },
    /**
     * STORE DATA
     */
    addHostel() {
      if (this.checkValidate()) {
        console.log("-->" + JSON.stringify(this.hostel));
        this.axios
          .post("/api/hostel/store", this.hostel)
          .then(response => {
            (this.msg.text = response.data.text),
              (this.msg.type = response.data.type);
            this.getHostels();
            this.hostel = {};
          })
          .catch(error => console.log(error));
      }
    },
    /**
     * EDIT SHOW DATA
     */
    editHostel(hos) {
      let to = this.moveToDown ? this.$refs.description.offsetTop - 60 : 0;
      window.scroll({
        top: to,
        left: 0,
        behavior: "smooth"
      });
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
      this.axios
        .post(`/api/hostel/update/${this.hostel.id}`, this.hostel)
        .then(res => {
          this.getHostels();
          this.isEdit = false;
          this.hostel = "";
          console.log(JSON.stringify(res));
        });
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
      if (!this.hostel.hostel_name) {
        this.onValidateMessage("sectionid", "sectionmsg");
        return false;
      } else if (!this.hostel.type) {
        this.onValidateMessage("typeid", "typemsg");
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