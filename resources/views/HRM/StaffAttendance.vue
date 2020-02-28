<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">HRM</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>/ Staff
        Attendance
      </h4>
    </div>
    <hr />
    <confirm v-if="makeAsHoliCheck == false" :url="props"></confirm>
    <div class="card">
      <div class="card-header">
        <h6>Select Attendance</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12 textbox">
            <label for="class">
              Role
              <strong>*</strong>
            </label>
            <select
              v-model="search_by_role"
              id="search_role_id"
              @keyup="onValidate(
                                    search_by_role,
                                    'search_role_id',
                                    'search_rolemsg'
                                )
                            "
              v-on:blur="
                                onValidate(
                                    search_by_role,
                                    'search_role_id',
                                    'search_rolemsg'
                                )
                            "
              class="inputbox"
            >
              <option value>Select</option>
              <option :value="role.id" v-for="role in roles" :key="role.id">{{ role.name }}</option>
            </select>
            <span id="search_rolemsg" class="error_message">Role is required</span>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12 textbox">
            <label for="name">Attendance Date</label>
            <vue-ctk-date-time-picker
              v-model="model.date"
              :only-date="true"
              :color="'#1b5e20'"
              :button-color="'#1b5e20'"
              :auto-close="true"
              :format="'YYYY/MM/DD'"
              :formatted="'l'"
            >
              <input
                id="date_id"
                @keyup="
                                    onValidate(model.date, 'date_id', 'datemsg')
                                "
                v-on:blur="
                                    onValidate(model.date, 'date_id', 'datemsg')
                                "
                class="inputbox"
                autocomplete="off"
              />
            </vue-ctk-date-time-picker>
            <span id="datemsg" class="error_message">Attendance Date is required</span>
          </div>
          <div class="col-12">
            <button @click="searchByRole()" class="searchButton">Search</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showForm == true" class="card">
      <div class="card-header">
        <h6>Staff List</h6>
      </div>
      <div class="card-body">
        <label
          data-toggle="modal"
          data-target="#exampleModalCenter"
          class="btn btn-dark smallButton"
          @click="confirmBox()"
        >
          <input
            @change="check($event)"
            :checked="makeAsHoliCheck"
            type="checkbox"
            style="margin-right:5px;"
          />
          Mark as holiday
        </label>
        <a
          @click="submit"
          style="outline:none;float:right;color: white;"
          class="btn btn-dark smallButton"
        >Save Attendance</a>
        <div class="row" id="row" style="width:100%;">
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>No</th>
                  <th class="all" nowrap>Staff ID</th>
                  <th class="all" nowrap>Name</th>
                  <th class="all" nowrap>Role</th>
                  <th class="all" colspan="4" nowrap>Attendance</th>
                  <th class="all" nowrap>Note</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="staff in staffs" :key="staff.id" class="active">
                  <td class="all" nowrap>1</td>
                  <td class="all" nowrap>9001</td>
                  <td class="all" nowrap>{{ staff.name }}</td>
                  <td class="all" nowrap>{{ staff.role.name }}</td>
                  <td class="all" nowrap v-for="type in attendance_type" :key="type.id">
                    <input
                      style="cursor: pointer;"
                      type="radio"
                      :id="staff.id + type.type"
                      :name="staff.id"
                      :checked="isSelected"
                      @click="
                                                toggleValue(staff.id, type.id)
                                            "
                      :disabled="disabled == 1"
                    />
                    <label :for="staff.id + type.type">
                      {{
                      type.type
                      }}
                    </label>
                  </td>
                  <td>
                    <input type="text" class="note" :disabled="disabled == 1" v-model="staff.note" />
                  </td>
                </tr>
              </tbody>
            </table>
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
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import moment from "moment";

export default {
  components: {
    VueCtkDateTimePicker,
    confirm,
    message
  },
  data() {
    return {
      props: {
        url: "",
        type: ""
      },
      roles: [],
      staffs: [],
      formData: { data: [] },
      checkboxs: [],
      model: {},
      type: "",
      present: "",
      search_by_role: "",
      selection: {},
      status: 0,
      disabled: 0,
      isSelected: true,
      makeAsHoliCheck: false,
      showForm: false,
      confirmUrl: "",
      attendance_type: []
    };
  },
  created() {
    EventBus.$on("clicked", response => {
      console.log("-->" + JSON.stringify(response.check));
      this.makeAsHoliCheck = response.check;
      this.disabled = response.disabled;
    });
    this.axios.get("/api/attendancetypes").then(response => {
      this.attendance_type = response.data;
      console.log("Attendance" + JSON.stringify(this.attendance_type));
    });
    this.getRoles();
    this.getStaffs();
  },
  methods: {
    toggleValue(id, type_id) {
      this.model.attendance = type_id;
      for (var i = 0; i < this.staffs.length; i++) {
        if (id == this.staffs[i].id) {
          this.staffs[i].attendance_type = type_id;
          this.status = 1;
          break;
        }
      }
    },
    getStaffs() {
      this.axios.get("/api/staffs").then(response => {
        console.log(JSON.stringify(response.data));
        this.staffs = response.data;
        console.log("Hello ==>" + JSON.stringify(this.staffs));
      });
    },
    getRoles() {
      this.axios.get("/api/roles").then(response => {
        this.roles = response.data;
      });
    },
    attendanceData() {
      alert(this.model.date);
      this.model.date = moment(String(this.model.date)).format("YYYY/MM/DD");
      alert("Model" + this.model.date);

      if (this.makeAsHoliCheck) {
        /**Holiday */
        this.formData.data = [];
        for (var s = 0; s < this.staffs.length; s++) {
          this.formData.data.push({
            date: this.model.date,
            staff_id: this.staffs[s].id,
            staff_attendance_type_id: 5,
            note: this.staffs[s].note
          });
        }
      } else {
        for (var i = 0; i < this.staffs.length; i++) {
          if (this.staffs[i].attendance_type) {
          } else {
            /**Present */
            console.log(
              "Type Empty column ==>" + JSON.stringify(this.staffs[i])
            );
            this.staffs[i].attendance_type = 1;
          }
        }
        this.formData.data = [];

        for (var s = 0; s < this.staffs.length; s++) {
          /**Other Type */
          this.formData.data.push({
            date: this.model.date,
            staff_id: this.staffs[s].id,
            staff_attendance_type_id: this.staffs[s].attendance_type,
            note: this.staffs[s].note
          });
        }
      }
    },
    submit() {
      this.attendanceData();
      setTimeout(() => {
        this.axios
          .post(`/api/staffattendance/store`, this.formData)
          .then(response => {
            console.log("===>" + JSON.stringify(response.data));
          });
      }, 100);
    },
    confirmBox() {
      this.props.type = "confirm";
    },
    check: function(e) {
      console.log(e.target.checked);
      e.target.checked = false;
      this.makeAsHoliCheck = false;
      if (this.makeAsHoliCheck == false) {
        this.disabled = 0;
      }
    },
    searchByRole() {
      if (this.checkValidate()) {
        this.axios
          .get(`/api/staffdirectory/search_by_role/${this.search_by_role}`)
          .then(response => {
            this.staffs = response.data;
            for (var i = 0; i < this.staffs.length; i++) {
              this.staffs[i].note = "";
            }
            this.showForm = true;
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
      if (!this.search_by_role) {
        this.onValidateMessage("search_role_id", "search_rolemsg");
        return false;
      }
      if (!this.model.date) {
        this.onValidateMessage("date_id", "datemsg");
        return false;
      } else {
        return true;
      }
      return false;
    }
  }
};
</script>
