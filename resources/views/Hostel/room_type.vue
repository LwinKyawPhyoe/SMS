<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Hostel</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Room Type
      </h4>
    </div>
    <hr />
    <confirm :url="delurl"></confirm>
    <div class="row" style="align-items: end !important;margin-left: 0px;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Room Type</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" />
            <form @submit.prevent="addRoomType">
              <div class="col-12">
                <label for="roomtype">
                  Room Type
                  <strong>*</strong>
                </label>
                <input
                  type="text"
                  class="inputbox"
                  v-model="room.room_type"
                  id="sectionid"
                  @keyup="onValidate(room.room_type, 'sectionid', 'sectionmsg')"
                  v-on:blur="onValidate(room.room_type, 'sectionid', 'sectionmsg')"
                />
                <span id="sectionmsg" class="error_message">Room Type is required</span>
              </div>
              <div class="col-12 end">
                <label for="description">Description</label>
                <textarea class="textareas" rows="3" v-model="room.description"></textarea>
              </div>
              <div class="col-12">
                <!--- store -->
                <button v-if="this.isEdit == false" id="globalSave" type="submit" class="save">Save</button>
                <button
                  v-else
                  @click="updateRoomType()"
                  id="globalSave"
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
            <h6>Room Type List</h6>
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
                  <a
                    href="#"
                    @click.prevent="downloadExcel('studenttable', 'name', 'Room_Type.xls')"
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
                    <th class="all" nowrap>Room Type</th>
                    <th class="all" nowrap style="text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(roomType) in roomtypes" v-bind:key="roomType.id" class="active">
                    <td class="all" nowrap>
                      <p class="toolText">
                        {{roomType.room_type}}
                        <span
                          v-if="roomType.description"
                          class="tooltipLabel"
                        >{{roomType.description}}</span>
                        <span v-else class="tooltipLabel text-danger">No Description</span>
                      </p>
                    </td>
                    <td style="text-align: right;">
                      <i @click="editRoomType(roomType)" class="fa fa-pencil pen">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        class="fa fa-trash time"
                        data-id="hos"
                        @click="deleteRoomType(roomType.id)"
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
export default {
  components: {
    confirm,
    message
  },
  data() {
    return {
      search: "",
      room: {},
      roomtypes: [],
      isEdit: false,
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
    this.getRoomTypes();
  },
  created() {
    EventBus.$on("clicked", response => {
      this.getRoomTypes();
    });
    this.axios
      .get("/api/roomtypes")
      .then(response => (this.roomtypes = response.data));
  },
  methods: {
    getRoomTypes() {
      this.axios
        .get("/api/roomtypes")
        .then(response => (this.roomtypes = response.data));
    },
    addRoomType() {
      console.log(JSON.stringify(this.room.room_type));
      if (this.checkValidate()) {
        this.axios
          .post("/api/roomtype/store", this.room)
          .then(response => {
            this.getRoomTypes();
            (this.msg.text = response.data.text),
              (this.msg.type = response.data.type);
            let to = this.moveToDown
              ? this.$refs.description.offsetTop - 60
              : 0;
            window.scroll({
              top: to,
              left: 0,
              behavior: "smooth"
            });
            this.moveToDown = !this.moveToDown;
            this.room = {};
            this.moveToDown = !this.moveToDown;
            setTimeout(() => {
              this.room = {};
            }, 100);
          })
          .catch(error => console.log(error));
      }
    },
    editRoomType(data) {
      let to = this.moveToDown ? this.$refs.description.offsetTop - 60 : 0;
      window.scroll({
        top: to,
        left: 0,
        behavior: "smooth"
      });
      this.moveToDown = !this.moveToDown;
      this.room = {};
      this.moveToDown = !this.moveToDown;
      this.room.id = data.id;
      this.room.room_type = data.room_type;
      this.room.description = data.description;
      this.isEdit = true;
    },
    updateRoomType() {
      console.log(JSON.stringify(this.room));
      this.axios
        .post(`/api/roomtype/update/${this.room.id}`, this.room)
        .then(res => {
          this.isEdit = false;
          this.room = "";
          this.getRoomTypes();
          console.log(JSON.stringify(res));
        });
    },
    deleteRoomType(id) {
      var funName = "delete"; /**Delete function */
      this.delurl = `roomtype/${funName}/${id}`;
    },
    searchData() {
      if (this.search == "") {
        this.axios.get(`api/roomtypes`).then(response => {
          this.roomtypes = [];
          this.roomtypes = response.data;
        });
      } else {
        this.axios.get(`api/roomtype/search/${this.search}`).then(response => {
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
      if (!this.room.room_type) {
        Util.onValidateMessage("sectionid", "sectionmsg");
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