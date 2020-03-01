<template>
  <div class="form ViewStaffDirectory" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">HRM</h4>
      <h6>
        <router-link to="/home">Home</router-link>
        <router-link to="/staffdirectory">> Staff Directory</router-link>> View Staff Directory
      </h6>
    </div>
    <hr />
    <Loading></Loading>
    <div class="row" id="row">
      <div class="col-lg-4 col-md-12">
        <div class="card" id="globalCard">
          <div class="card-header" id="globalcardHeader">
            <h6>Staff Profiles</h6>
          </div>
          <div class="card-body tableCard" id="globalcardBody">
            <div class="Profile">
              <img :src="'/staff_images/'+ image" alt />
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
                class="tab tabTheme"
                id="profile"
                onclick="toggleBtn('profile','attendance','document','timeline')"
                @click="showForm('profile')"
              >Profile</button>
              <button
                class="tab1 tabTheme"
                id="attendance"
                style="margin-left: -5px;"
                onclick="toggleBtn('attendance','profile','document','timeline')"
                @click="showForm('attendance')"
              >Attendance</button>
              <button
                class="tab2 tabTheme"
                style="margin-left: -5px;"
                id="document"
                onclick="toggleBtn('document','profile','attendance','timeline')"
                @click="showForm('document')"
              >Documents</button>
              <button
                class="tab3 tabTheme"
                style="margin-left: -5px;"
                id="timeline"
                onclick="toggleBtn('timeline','profile','document','attendance')"
                @click="showForm('timeline')"
              >Timeline</button>
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-12" v-for="(data) in count_attendances">
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
                    <option selected disabled>Select Year</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
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
            <div class="copyRows">
              <div class="row" id="copyRow" style="margin-bottom:1rem;margin-top:0px;">
                <div class="col-2">
                  <a href="#" title="Excel">
                    <i class="fa fa-file-excel-o"></i>
                  </a>
                </div>
                <div class="col-2">
                  <a href="#" title="Print">
                    <i class="fa fa-print"></i>
                  </a>
                </div>
                <div class="col-2">
                  <a href="#" title="Columns">
                    <i class="fa fa-columns"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="height: 70vh;padding: 0;">
              <table class="table table-hover table-striped">
                <thead>
                  <tr nowrap class="active">
                    <th nowrap>Month | Date</th>
                    <th class="table_header" nowrap v-for="(day) in days">{{day.day}}</th>
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
                    >
                      <span v-for="(type) in ary">
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
                <p v-if="documentempty == true">No Data</p>
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
          <div class="card-body timelinebody" id="globalcardBody" v-if="timeline === true">
            <button class="add">Add</button>
            <div class="TimeLine">
              <span>09-09-2000</span>
              <div class="timeline">
                <div class="container right">
                  <div class="content" style="height: fit-content;">
                    <h6>Won Chess Championship Award</h6>
                    <p>Edward has won 1st Place in Inter school chess championship award.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="TimeLine">
              <span>09-09-2000</span>
              <div class="timeline">
                <div class="container right">
                  <div class="content" style="height: fit-content;">
                    <h6>Won Chess Championship Award</h6>
                    <p>Edward has won 1st Place in Inter school chess championship award.</p>
                  </div>
                </div>
              </div>
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
export default {
  components: {
    Loading
  },
  data() {
    return {
      countcomment: "",
      search_by_year: "",
      profile: true,
      attendance: false,
      document: false,
      timeline: false,
      documentempty: false,
      count_attendances: [],
      attendance_type: [],
      months: [],
      days: [],
      documents: [],
      staffs: {},
      image: "",
      name: "",
      present: 0,
      late: 0,
      absent: 0,
      halfday: 0,
      holiday: 0,
      countDown: { data: [] },
      ary: [],
      ary_types: []
    };
  },
  created() {
    EventBus.$emit("ThemeClicked");
    this.getProfile();
    this.countAttendance();
    this.getMonth();
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
        this.axios.get(`/api/getYears`).then(response => {
          console.log("Years" + JSON.stringify(response.data));
        });
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
        this.profile = false;
        this.attendance = false;
        this.document = false;
        this.timeline = true;
      }
    },
    searchAttendanceByDate() {
      EventBus.$emit("onLoad");
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
    getProfile() {
      this.axios
        .get(`/api/staffdirectory/show/${this.$route.params.id}`)
        .then(response => {
          this.documents = response.data;
          this.staffs = response.data;
          this.image = response.data.image;
          this.name = response.data.name;

          if (
            !this.staffs.resume &&
            !this.staffs.joining_letter &&
            !this.staffs.other_document
          ) {
            this.documentempty = true;
          }
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
    }
  }
};
</script>