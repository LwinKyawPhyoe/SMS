<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Hostel</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Hostel Rooms
      </h4>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <Loading></Loading>
    <div class="row" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Hostel Room</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" id="alertmsg" />

            <form @submit.prevent="addHostelRooms">
              <div class="col-12">
                <label for="room_no">
                  Room Number / Name
                  <strong>*</strong>
                </label>
                <input
                  autocomplete="off"
                  id="name_id"
                  @keyup="onValidate(hostelroom.room_no, 'name_id', 'namemsg')"
                  v-on:blur="onValidate(hostelroom.room_no, 'name_id', 'namemsg')"
                  v-model="hostelroom.room_no"
                  type="text"
                  class="inputbox"
                />
                <span id="namemsg" class="error_message">Room Number / Name is required</span>
              </div>
              <div class="col-12">
                <label for="hostel">
                  Hostel
                  <strong>*</strong>
                </label>
                <select
                  id="hostel_id"
                  @keyup="onValidate(hostelroom.hostel_id, 'hostel_id', 'hostelmsg')"
                  v-on:blur="onValidate(hostelroom.hostel_id, 'hostel_id', 'hostelmsg')"
                  v-model="hostelroom.hostel_id"
                  class="inputbox"
                  name="class"
                >
                  <option selected disabled>Select</option>
                  <option
                    :value="hostel_data.id"
                    v-for="(hostel_data) in hostel_table"
                    v-bind:key="hostel_data.id"
                  >{{hostel_data.hostel_name}}</option>
                </select>
                <span id="hostelmsg" class="error_message">Hostel is required</span>
              </div>
              <div class="col-12">
                <label for="room_type">
                  Room Type
                  <strong>*</strong>
                </label>
                <select
                  id="roomtype_id"
                  @keyup="onValidate(hostelroom.room_type_id, 'roomtype_id', 'roomtypemsg')"
                  v-on:blur="onValidate(hostelroom.room_type_id, 'roomtype_id', 'roomtypemsg')"
                  v-model="hostelroom.room_type_id"
                  class="inputbox"
                  name="class"
                >
                  <option selected disabled>Select</option>
                  <option
                    :value="roomtype_data.id"
                    v-for="(roomtype_data) in roomtypes"
                    v-bind:key="roomtype_data.id"
                  >{{roomtype_data.room_type}}</option>
                </select>
                <span id="roomtypemsg" class="error_message">Room Type is required</span>
              </div>
              <div class="col-12">
                <label for="no_of_bed">
                  Number Of Bed
                  <strong>*</strong>
                </label>
                <input
                  autocomplete="off"
                  id="nob_id"
                  @keyup="onValidate(hostelroom.no_of_bed, 'nob_id', 'nobmsg')"
                  v-on:blur="onValidate(hostelroom.no_of_bed, 'nob_id', 'nobmsg')"
                  v-model="hostelroom.no_of_bed"
                  type="number"
                  class="inputbox"
                />
                <span id="nobmsg" class="error_message">Number Of Bed is required</span>
              </div>
              <div class="col-12">
                <label for="cost_per_bed">
                  Cost Per Bed
                  <strong>*</strong>
                </label>
                <input
                  autocomplete="off"
                  id="cpb_id"
                  @keyup="onValidate(hostelroom.cost_per_bed, 'cpb_id', 'cpbmsg')"
                  v-on:blur="onValidate(hostelroom.cost_per_bed, 'cpb_id', 'cpbmsg')"
                  v-model="hostelroom.cost_per_bed"
                  type="number"
                  class="inputbox"
                />
                <span id="cpbmsg" class="error_message">Cost Per Bed is required</span>
              </div>
              <div class="col-12 end">
                <label for="description">Description</label>
                <textarea
                  autocomplete="off"
                  v-model="hostelroom.description"
                  class="textareas"
                  rows="3"
                ></textarea>
              </div>
              <div class="col-12">
                <button v-if="this.isEdit == false" type="submit" id="globalSave" class="save">Save</button>
                <button
                  v-else
                  @click="updateHostelRoom()"
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
            <h6>Hostel Room List</h6>
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
                    @click.prevent="downloadExcel('studenttable', 'name', 'Hostel_Room.xls')"
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
                    <th class="all" nowrap>Room Number</th>
                    <th class="all" nowrap>Hostel</th>
                    <th class="all" nowrap>Room Type</th>
                    <th class="all" nowrap>Number Of Bed</th>
                    <th class="all" nowrap>Cost Per Bed</th>
                    <th class="all" nowrap>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <div v-if="isEmpty == true" class="NoData">No Data</div>
                  <tr v-else v-for="(room) in hostelrooms" v-bind:key="room.id" class="active">
                    <td class="all" nowrap>
                      <p class="toolText">
                        {{room.room_no}}
                        <span
                          v-if="room.description"
                          class="tooltipLabel"
                        >{{room.description}}</span>
                        <span v-else class="tooltipLabel text-danger">No Description</span>
                      </p>
                    </td>
                    <td class="all" nowrap>{{room.hostel.hostel_name}}</td>
                    <td class="all" nowrap>{{room.room_type.room_type}}</td>
                    <td class="all" nowrap>{{room.no_of_bed}}</td>
                    <td class="all" nowrap>{{room.cost_per_bed}}</td>
                    <td>
                      <i @click="editHostelRoom(room)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        class="fa fa-trash time"
                        @click="deleteHostelRoom(room.id)"
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
      hostelroom: {},
      msg: {
        text: "",
        type: ""
      },
      deletemsg: {
        text: "",
        type: ""
      },
      search: "",
      hostelrooms: [],
      hostel_table: [],
      roomtypes: [],
      isEdit: false,
      isEmpty: false,
      noMatc: false
    };
  },
  mounted() {
    EventBus.$emit("onLoad");
    this.getHostels();
    this.getRoomTypes();
    this.getHostelRooms();
  },
  created() {
    EventBus.$emit("ThemeClicked");
    EventBus.$on("clicked", response => {
      (this.deletemsg.text = response.text),
        (this.deletemsg.type = response.type);
      Util.workAlert("#delalertmsg");
      this.getHostels();
      this.getRoomTypes();
      this.getHostelRooms();
    });
    this.getHostels();
    this.getRoomTypes();
    this.getHostelRooms();
  },
  methods: {
    /***
     * HostelRoom
     */
    getHostelRooms() {
      this.axios.get("/api/hostelrooms").then(response => {
        this.hostelrooms = response.data;
        if (this.hostelrooms.length > 0) {
          this.isEmpty = false;
        } else {
          this.isEmpty = true;
        }
        EventBus.$emit("onLoadEnd");
        console.log("GetHostelRooms" + JSON.stringify(response.data));
      });
    },
    addHostelRooms() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad", "1");
        console.log("-->" + JSON.stringify(this.hostelroom));
        this.axios
          .post("/api/hostelroom/store", this.hostelroom)
          .then(response => {
            this.getHostelRooms();
            this.hostelroom = {};
            EventBus.$emit("onLoadEnd");
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            Util.scrollToTop();
          })
          .catch(error => console.log(error));
      }
    },
    editHostelRoom(hos) {
      Util.scrollToTop();
      this.hostelroom = {};
      this.hostelroom.id = hos.id;
      this.hostelroom.hostel_id = hos.hostel_id;
      this.hostelroom.room_type_id = hos.room_type_id;
      this.hostelroom.room_no = hos.room_no;
      this.hostelroom.no_of_bed = hos.no_of_bed;
      this.hostelroom.cost_per_bed = hos.cost_per_bed;
      this.hostelroom.description = hos.description;
      this.isEdit = true;
    },
    updateHostelRoom() {
      if (this.checkValidate()) {
        console.log("Model --->" + JSON.stringify(this.hostelroom));
        EventBus.$emit("onLoad", "1");
        this.axios
          .post(`/api/hostelroom/update/${this.hostelroom.id}`, this.hostelroom)
          .then(response => {
            this.getHostelRooms();
            this.isEdit = false;
            this.hostelroom = "";
            EventBus.$emit("onLoadEnd");
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
            Util.workAlert("#alertmsg");
            Util.scrollToTop();

            console.log(JSON.stringify(response));
          });
      }
    },
    deleteHostelRoom(id) {
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `hostelroom/${funName}/${id}`;
    },
    /***
     * Hostel
     */
    getHostels() {
      this.axios.get("/api/hostels").then(response => {
        this.hostel_table = response.data;
        console.log(JSON.stringify(this.hostel_table));
      });
    },
    /***
     * Room Type
     */
    getRoomTypes() {
      this.axios.get("/api/roomtypes").then(response => {
        this.roomtypes = response.data;
        console.log(JSON.stringify(this.roomtypes));
      });
    },

    /***
     * SEARCH FILTER
     */
    searchData() {
      if (this.search == "") {
        this.axios.get(`api/hostelrooms`).then(response => {
          this.hostelrooms = [];
          this.noMatch = false;
          this.hostelrooms = response.data;
        });
      } else {
        this.axios
          .get(`api/hostelroom/search/${this.search}`)
          .then(response => {
            console.log(JSON.stringify(response.data));
            this.hostelrooms = [];
            this.hostelrooms = response.data;
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
      if (!this.hostelroom.room_no) {
        Util.onValidateMessage("name_id", "namemsg");
      }
      if (!this.hostelroom.hostel_id) {
        Util.onValidateMessage("hostel_id", "hostelmsg");
      }
      if (!this.hostelroom.room_type_id) {
        Util.onValidateMessage("roomtype_id", "roomtypemsg");
      }
      if (!this.hostelroom.no_of_bed) {
        Util.onValidateMessage("nob_id", "nobmsg");
      }
      if (!this.hostelroom.cost_per_bed) {
        Util.onValidateMessage("cpb_id", "cpbmsg");
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