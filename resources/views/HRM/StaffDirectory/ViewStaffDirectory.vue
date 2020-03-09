<template>
  <div class="form ViewStaffDirectory" id="bar">
    <!-- right side menu -->
    <div class="sta-menu-open ripple" style="position: fixed;right: 2rem;top: 5rem;z-index: 1;">
      <i @click="showRightSideMenu()" class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="right-side-menu" id="right-side-menu">
      <div class="statop">
        <div class="statopfixed">
          <p class="classtap">
            Staff
            <a @click="closeRightSideMenu()" class="staclose">
              <i class="fa fa-times"></i>
            </a>
          </p>
          <div class="scrollmenu ripple">
            <a
              class="ripple"
              v-for="(role,i) in roles"
              :key="i"
              :class="{ 'sta-active': activeItem ===  role.id }"
              @click="selectItem(role.id)"
            >{{role.name}}</a>
          </div>
        </div>
      </div>
      <div class="sta-content">
        <div v-if="nodata == true" class="NoData">No Data</div>
        <div
          v-else
          class="sta-name ripple"
          v-for="(staff, s) in stafflists"
          :key="s"
          @click="clickStaff(staff.id)"
        >
          <a>
            <div class="icon">
              <img :src="'/staff_images/'+ staff.image" alt v-if="staff.image" />
              <img v-else src="/noimage.jpg" />
            </div>
            <div class="sta-title">{{staff.name}}</div>
          </a>
        </div>
      </div>
    </div>
    <!--end of right side menu -->
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">HRM</h4>
      <h6>
        <router-link to="/home">Home</router-link>
        <router-link to="/staffdirectory">> Staff Directory</router-link>> View Staff Directory
      </h6>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <Loading></Loading>
    <!-- Timeline modal -->
    <div
      class="modal fade"
      id="addTimeline"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:500px !important;">
          <form @submit.prevent="addStaffTimeline()">
            <div class="modal-body" style="padding:0;">
              <div class="card-header" id="globalcardHeader" style="width: 100%;margin-left: 0;">
                <h6>Add Timeline</h6>
                <i
                  class="fa fa-close"
                  data-dismiss="modal"
                  style="cursor: pointer;padding: 0 10px;position: absolute;right: 5px;"
                ></i>
              </div>
              <div class="textbox" style="width: 100% !important;padding: 0 1rem;">
                <label>Title</label>
                <input v-model="form.title" type="text" class="inputbox" name="title" />
              </div>
              <div class="textbox" style="width: 100% !important;padding: 0 1rem;">
                <label>
                  Date
                  <strong>*</strong>
                </label>
                <datepicker v-model="form.date"></datepicker>
              </div>
              <div class="text" style="width: 100% !important;padding: 0 1rem;">
                <label for="description">Description</label>
                <textarea v-model="form.description" class="textareas" rows="3"></textarea>
              </div>
              <div class="text" style="width: 100% !important;padding: 0 1rem;">
                <label for="attach">Attach Document</label>
                <input type="file" class="inputbox" id="attach" />
              </div>
              <div class="text" style="width: 100% !important;padding: 1rem;">
                <label for="visible" style="display: flex;align-items: center;">
                  Visible to this person
                  <input type="checkbox" />
                </label>
              </div>
            </div>
            <div class="modal-footer" style="padding-top: 0;">
              <button type="submit" id="globalSave" class="save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row" id="row">
      <div class="col-lg-4 col-md-12">
        <div class="card" id="globalCard">
          <div class="card-header" id="globalcardHeader">
            <h6>Staff Profiles</h6>
          </div>
          <div
            class="card-body tableCard"
            id="globalcardBody"
            :class="{ 'sta-disable': staffs.is_active ===  'no' }"
          >
            <div class="Profile">
              <img :src="'/staff_images/'+ image" alt v-if="image" />
              <img v-else src="/noimage.jpg" />
              <i
                v-if="staffs.is_active == 'no'"
                title="Staff is Disabled"
                class="fa fa-ban disableIcon"
                aria-hidden="true"
              ></i>
              <h5 class="name">{{name}}</h5>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="all" nowrap>
                      <b>Staff ID</b>
                    </td>
                    <td class="all" nowrap>
                      <input readonly class="input_readonly" v-model="staffs.staff_id" />
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Role</b>
                    </td>
                    <td class="all" nowrap>
                      <input readonly class="input_readonly" v-model="staffs.role.name" />
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Designation</b>
                    </td>
                    <td class="all" nowrap>
                      <input
                        readonly
                        class="input_readonly"
                        v-model="staffs.designation.designation_name"
                      />
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Department</b>
                    </td>
                    <td class="all" nowrap>
                      <input
                        readonly
                        class="input_readonly"
                        v-model="staffs.department.department_name"
                      />
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Date Of Joining</b>
                    </td>
                    <td class="all" nowrap>
                      <input readonly class="input_readonly" v-model="staffs.date_of_joining" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12">
        <div class="card">
          <div class="card-header detailsCard">
            <div class="buttonCard">
              <button
                class="tab tabTheme staffTab"
                id="profile"
                onclick="toggleBtn('profile','attendance','document','timeline')"
                @click="showForm('profile')"
              >Profile</button>
              <button
                class="tab1 tabTheme staffTab"
                id="attendance"
                style="margin-left: -5px;"
                onclick="toggleBtn('attendance','profile','document','timeline')"
                @click="showForm('attendance')"
              >Attendance</button>
              <button
                class="tab2 tabTheme staffTab"
                style="margin-left: -5px;"
                id="document"
                onclick="toggleBtn('document','profile','attendance','timeline')"
                @click="showForm('document')"
              >Documents</button>
              <button
                class="tab3 tabTheme staffTab"
                style="margin-left: -5px;"
                id="timeline"
                onclick="toggleBtn('timeline','profile','document','attendance')"
                @click="showForm('timeline')"
              >Timeline</button>
            </div>
            <div style="position: absolute; right : 20px;padding: 0 10px;">
              <router-link :to="{name: 'editstadirectory', params: { id: $route.params.id }}">
                <i class="fa fa-pencil"></i>
              </router-link>
              <i title="Change Password" style="margin:0 15px;" class="fa fa-key"></i>
              <i
                v-if="staffs.is_active == 'no'"
                @click="enableRecord()"
                title="Enable"
                class="fa fa-thumbs-up"
                aria-hidden="true"
              ></i>
              <i
                v-if="staffs.is_active == 'no'"
                @click="deleteRecord()"
                title="Enable"
                class="fa fa-trash"
                aria-hidden="true"
                data-toggle="modal"
                style="margin-left:15px;"
                data-target="#exampleModalCenter"
              ></i>
              <i
                v-else
                @click="disableRecord()"
                title="Disable"
                class="fa fa-thumbs-o-down"
                aria-hidden="true"
              ></i>
            </div>
          </div>
          <div class="card-body" id="globalcardBody" v-if="profile === true">
            <div class="detailsCardBody">
              <div class="table-responsive">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td class="all" nowrap>
                        <b>Father Name</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.father_name" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Mother Name</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.mother_name" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Phone</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.phone" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Emergency Contact Number</b>
                      </td>
                      <td class="all" nowrap>
                        <input
                          readonly
                          class="input_readonly"
                          v-model="staffs.emergency_contact_no"
                        />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Email</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.email" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Gender</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.gender" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Date Of Birth</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.dob" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Marital Status</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.marital_status" />
                      </td>
                    </tr>

                    <tr>
                      <td class="all" nowrap>
                        <b>Current Address</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.current_address" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Permanent Address</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.permanent_address" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Qualification</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.qualification" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Work Experience</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.work_exp" />
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Note</b>
                      </td>
                      <td class="all" nowrap>
                        <input readonly class="input_readonly" v-model="staffs.note" />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Staff Attendance -->
          <div class="card-body attendanceBody" id="globalcardBody" v-if="attendance === true">
            <div class="attendance">
              <div class="row">
                <div
                  class="col-lg-4 col-md-4 col-sm-6 col-12"
                  v-for="(data , i) in count_attendances"
                  :key="i"
                >
                  <div class="attendanceCard">
                    <h4 class="day">Total {{data.name}}</h4>
                    <b class="number" v-if="data.name == 'Late'" style="color: red;">{{data.data}}</b>
                    <b v-else class="number">{{data.data}}</b>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:1rem;">
                <div class="col-lg-4 col-12 year">
                  <label for="year">Year</label>
                  <select
                    v-model="search_by_year"
                    @change="searchAttendanceByDate()"
                    class="inputbox"
                  >
                    <!-- <option value selected disabled>Select Year</option> -->
                    <option
                      selected
                      v-for="(data,i) in years"
                      :key="i"
                      :value="data.year"
                    >{{data.year}}</option>
                  </select>
                </div>
                <div class="col-lg-8 col-12 text">
                  <label for="present" v-for="(type) in attendance_type" :key="type.id">
                    {{type.type}} :
                    <b v-html="type.key_value"></b>
                  </label>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="height: 70vh;padding: 0;">
              <table class="table table-hover table-striped">
                <thead>
                  <tr nowrap class="active">
                    <th nowrap>Month | Date</th>
                    <th class="table_header" nowrap v-for="(day ,i) in days" :key="i">{{day.day}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    style="height: 40px;"
                    class="active"
                    v-for="(month ,month_index) in months"
                    :key="month_index"
                  >
                    <td class="table_right" nowrap>{{month.month}}</td>
                    <td
                      style="width: 50px;text-align:center;"
                      nowrap
                      v-for="(day, day_index) in days"
                      :key="day_index"
                    >
                      <span v-for="(type ,i) in ary" :key="i">
                        <span v-if="type.month == month.month && type.date == day.day">
                          <b v-html="type.data" :title="type.note"></b>
                        </span>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-body documentbody" id="globalcardBody" v-if="document === true">
            <div class="document">
              <div class="row">
                <div class="NoData" v-if="documentempty == true">No Data</div>
                <div v-if="staffs.resume" class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">{{staffs.resume}}</h4>
                    <b class="number">
                      <i class="fa fa-download download"></i>
                      <i class="fa fa-trash time text-danger"></i>
                    </b>
                  </div>
                </div>
                <div v-if="staffs.joining_letter" class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">{{staffs.joining_letter}}</h4>
                    <b class="number">
                      <i class="fa fa-download download"></i>
                      <i class="fa fa-trash time text-danger"></i>
                    </b>
                  </div>
                </div>
                <div v-if="staffs.other_document" class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">{{staffs.other_document}}</h4>
                    <b class="number">
                      <i class="fa fa-download download"></i>
                      <i class="fa fa-trash time text-danger"></i>
                    </b>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body TimeLine" v-if="timeline === true">
            <button class="add" data-toggle="modal" data-target="#addTimeline">Add</button>
            <div v-for="(time, i) in timelines" :key="i">
              <span class="timelineSpan">{{time.timeline_date}}</span>
              <div class="timeline">
                <div class="container right">
                  <div class="timelineContent" style="height: fit-content;">
                    <i class="fa fa-list-alt timeIcon"></i>
                    <h6 class="timelineTitle">{{time.title}}</h6>
                    <p>{{time.description}}</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="timelineBottom">
              <i class="fa fa-calendar timeIcon"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";
import Loading from "../../LoadingController.vue";
import { EventBus } from "../../../js/event-bus.js";
import confirm from "../../message/confirm.vue";
import datepicker from "../../datepicker.vue";

export default {
  components: {
    Loading,
    confirm,
    datepicker
  },
  data() {
    return {
      props: {
        url: "",
        type: ""
      },
      id: null,
      activeItem: null,
      countcomment: "",
      search_by_year: "",
      profile: true,
      attendance: false,
      document: false,
      timeline: false,
      documentempty: false,
      nodata: false,
      count_attendances: [],
      attendance_type: [],
      months: [],
      days: [],
      documents: [],
      roles: [],
      staffs: {},
      stafflists: [],
      years: [],
      timelines: [],
      image: "",
      name: "",
      countDown: { data: [] },
      ary: [],
      ary_types: [],
      form: {}
    };
  },
  mounted() {
    EventBus.$emit("onLoad");
    EventBus.$emit("ThemeClicked");
  },
  created() {
    EventBus.$on("clicked", response => {
      this.$router.push({ name: "staffdirectory" });
    });
    this.id = this.$route.params.id;
    this.getProfile();
    this.getRoles();
    this.countAttendance();
    this.getMonth();
    this.getTimeLines();
    this.axios.get("/api/attendance_types").then(response => {
      this.attendance_type = response.data;
      console.log("Attendance" + JSON.stringify(this.attendance_type));
    });
  },
  methods: {
    showForm(name) {
      if (name == "profile") {
        this.profile = true;
        this.attendance = false;
        this.document = false;
        this.timeline = false;
      } else if (name == "attendance") {
        this.searchAttendanceByDate();

        this.profile = false;
        this.attendance = true;
        this.document = false;
        this.timeline = false;
      } else if (name == "document") {
        this.profile = false;
        this.attendance = false;
        this.document = true;
        this.timeline = false;
      } else if (name == "timeline") {
        EventBus.$emit("ThemeClicked");
        this.profile = false;
        this.attendance = false;
        this.document = false;
        this.timeline = true;
      }
    },
    selectItem(i) {
      this.activeItem = i;
      this.getStaffLists();
    },
    showRightSideMenu() {
      document.getElementById("right-side-menu").style.marginRight = "0px";
    },
    closeRightSideMenu() {
      document.getElementById("right-side-menu").style.marginRight = "-250px";
    },
    searchAttendanceByDate() {
      EventBus.$emit("onLoad");
      this.axios.get(`/api/getyears`).then(response => {
        this.years = response.data;
      });
      this.axios
        .get(`/api/searchDate/${this.$route.params.id}/${this.search_by_year}`)
        .then(response => {
          console.log("->" + JSON.stringify(response.data));
          this.ary_types = response.data;
        });
      setTimeout(() => {
        this.ary = [];
        for (var t = 0; t < this.ary_types.length; t++) {
          for (var tt = 0; tt < this.attendance_type.length; tt++) {
            var month = moment(this.ary_types[t].date).format("MMM");
            var date = moment(this.ary_types[t].date).format("D");
            if (
              this.ary_types[t].staff_attendance_type_id ==
              this.attendance_type[tt].id
            ) {
              this.ary.push({
                id: this.ary_types[t].id,
                data: this.attendance_type[tt].key_value,
                note: this.ary_types[t].note,
                month: month,
                date: date
              });
              console.log("log=>" + JSON.stringify(this.ary_types[t]));
            }
          }
        }
        console.log("Ary" + JSON.stringify(this.ary));
        EventBus.$emit("onLoadEnd");
      }, 1000);
    },
    /***
     * FETCH DATA
     */
    getRoles() {
      this.axios
        .get("/api/roles")
        .then(response => (this.roles = response.data));
    },
    getStaffLists() {
      this.axios
        .get(`/api/staffdirectory/search_staff_lists/${this.activeItem}`)
        .then(response => {
          this.stafflists = response.data;
          if (this.stafflists.length < 1) {
            this.nodata = true;
          } else {
            this.nodata = false;
          }
          console.log(JSON.stringify(response.data));
        });
    },
    getProfile() {
      this.axios.get(`/api/staffdirectory/show/${this.id}`).then(response => {
        this.documents = response.data;
        this.staffs = response.data;
        this.staffs.resume = "Resume";
        this.staffs.joining_letter = "Joining Letter";
        this.staffs.other_cocument = "Other Document";
        this.image = response.data.image;
        this.name = response.data.name;
        this.activeItem = this.staffs.role_id;
        this.getStaffLists();
        if (
          !this.staffs.resume &&
          !this.staffs.joining_letter &&
          !this.staffs.other_document
        ) {
          this.documentempty = true;
        }
        EventBus.$emit("onLoadEnd");
      });
    },
    getMonth() {
      this.axios.get("/api/months").then(response => {
        this.months = response.data;
        console.log(JSON.stringify(response));
        for (var i = 1; i < 32; i++) {
          this.days.push({ day: i });
        }
        console.log(this.days);
      });
    },
    countAttendance() {
      this.axios
        .get(`/api/staffattendance/show/${this.$route.params.id}`)
        .then(response => {
          console.log("-->" + JSON.stringify(response.data));
          this.count_attendances = response.data;
        });
    },
    getTimeLines() {
      this.axios.get("/api/staffdirectory/gettimelines").then(response => {
        this.timelines = response.data;
      });
    },

    /***
     * Advanced Options
     */
    clickStaff(id) {
      EventBus.$emit("onLoad");
      this.$router.push({ path: `/staffdirectory/profile/${id}` });
      this.id = this.$route.params.id;
      this.getProfile();
      this.countAttendance();
    },

    disableRecord() {
      EventBus.$emit("onLoad");
      this.axios
        .post(`/api/staffdirectory/staffdisable/${this.$route.params.id}`)
        .then(response => {
          this.getProfile();
        });
    },
    enableRecord() {
      EventBus.$emit("onLoad");
      this.axios
        .post(`/api/staffdirectory/staffenable/${this.$route.params.id}`)
        .then(response => {
          this.getProfile();
        });
    },
    deleteRecord(id) {
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `staffdirectory/delete/${this.$route.params.id}`;
    },
    /**
     Time Line Options
    */
    addStaffTimeline() {
      this.form.staff_id = this.$route.params.id;
      this.axios
        .post("/api/staffdirectory/addtimeline", this.form)
        .then(response => {});
    }
  }
};
</script>
