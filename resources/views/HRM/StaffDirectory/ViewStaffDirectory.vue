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
    <!-- <div class="progress">
      <div
        class="progress-bar"
        role="progressbar"
        style="width: {{percentage }}%"
        aria-valuenow="25"
        aria-valuemin="0"
        aria-valuemax="100"
      ></div>
    </div> -->
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
                      <p class="data">02/9/2013</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12">
        <div class="card" id="globalCard">
          <div class="card-header detailsCard" id="globalcardHeader">
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
          <div class="card-body attendanceBody" id="globalcardBody" v-if="attendance === true">
            <div class="attendance">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">Total Present</h4>
                    <h6 class="number">3</h6>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">Total Late</h4>
                    <h6 class="number">0</h6>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">Total Absent</h4>
                    <h6 class="number">2</h6>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">Total Half Day</h4>
                    <h6 class="number">3</h6>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="attendanceCard">
                    <h4 class="day">Total Holiday</h4>
                    <h6 class="number">2</h6>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:1rem;">
                <div class="col-lg-4 col-12 year">
                  <label for="year">Year</label>
                  <select class="inputbox">
                    <option selected disabled>Select Year</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                  </select>
                </div>
                <div class="col-lg-8 col-12 text">
                  <label for="present">Present : P</label>
                  <label for="present">Late : L</label>
                  <label for="present">Absent : A</label>
                  <label for="present">Half Day : F</label>
                  <label for="present">Holiday : H</label>
                </div>
              </div>
            </div>
            <div class="copyRows">
              <div class="row" id="copyRow" style="margin-bottom:1rem;margin-top:0px;">
                <div class="col-2">
                  <a href="#" title="Copy">
                    <i class="fa fa-copy"></i>
                  </a>
                </div>
                <div class="col-2">
                  <a href="#" title="Excel">
                    <i class="fa fa-file-excel-o"></i>
                  </a>
                </div>
                <div class="col-2">
                  <a href="#" title="PDF">
                    <i class="fa fa-file-pdf-o"></i>
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
          </div>

          <div class="card-body documentbody" id="globalcardBody" v-if="document === true">
            <h2 class="noLists">No Documents Found</h2>
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
export default {
  data() {
    return {
      percentage: "",
      countcomment:"",
      profile: true,
      attendance: false,
      document: false,
      timeline: false,
      colors: [],
      staffs: {},
      image: "",
      name: ""
    };
  },
  created() {
    this.getProfile();
  },
  methods: {
    showForm(name) {
      if (name == "profile") {
        this.profile = true;
        this.attendance = false;
        this.document = false;
        this.timeline = false;
      } else if (name == "attendance") {
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
    /***
     * FETCH DATA
     */
    getProfile() {
      this.axios
        .get(`/api/staffdirectory/show/${this.$route.params.id}`)
        .then(response => {
          this.staffs = response.data;
          this.image = response.data.image;
          this.name = response.data.name;
          console.log("Staff" + JSON.stringify(response));
        });
    }
  }
};
</script>