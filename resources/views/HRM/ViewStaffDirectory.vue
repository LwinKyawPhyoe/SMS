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

    <div class="row" id="row">
      <div class="col-lg-4 col-md-12">
        <div class="card" id="globalCard">
          <div class="card-header" id="globalcardHeader">
            <h6>Staff Profiles</h6>
          </div>
          <div class="card-body tableCard" id="globalcardBody">
            <div class="Profile">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ-SHM4sIFwbf_aRJ2VF6oxwikSggjK4IJ_XwRAfISgKLNJKs9Y"
              />
              <h6 class="name">Marry James</h6>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="all" nowrap>
                      <b>Staff ID</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">10293</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Role</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">Librarian</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Designation</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">Librarian</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Department</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">Library</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>EPF No</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">294905</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Basic Salary</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">130000</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Contract Type</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">Permanent</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Work Shift</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">Morning</p>
                    </td>
                  </tr>
                  <tr>
                    <td class="all" nowrap>
                      <b>Location</b>
                    </td>
                    <td class="all" nowrap>
                      <p class="data">3nd Floor</p>
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
                        <b>Phone</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">3245643</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Emergency Contact Number</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">87564343</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Email</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">marry@gmail.com</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Gender</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">Female</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Date Of Birth</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">08/22/1017</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Marital Status</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">Single</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Father Name</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">James Heart</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Mother Name</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">Marry</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Qualification</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">B.Lib.</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Work Experience</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">3 Yrs</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Note</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">You are Welcome</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="sub-header" id="globalsubHeader">
              <h6>Address</h6>
            </div>
            <div class="card-body addresscardBody" id="globalcardBody">
              <div class="table-responsive">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td class="all" nowrap>
                        <b>Current Address</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">Girls Hostel</p>
                      </td>
                    </tr>
                    <tr>
                      <td class="all" nowrap>
                        <b>Permanent Address</b>
                      </td>
                      <td class="all" nowrap>
                        <p class="data">Main Road</p>
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
                  <select class="inputbox" name="class">
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
      profile: true,
      attendance: false,
      document: false,
      timeline: false,
      colors: []
    };
  },
  created() {},
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
    }
  }
};
</script>