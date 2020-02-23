<template>
  <div class="StudentInformation" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link class="home" to="/Student">Home</router-link>> Student Details
      </h6>
    </div>
    <hr />
    <br />
    <div class="card">
      <div class="card-header">
        <h6>Student Criteria</h6>
      </div>
      <div class="stucard-body">
        <div class="row">
          <div class="textbox">
            <label for="class">
              Class
              <strong>*</strong>
            </label>
            <select id="class" class="inputbox">
              <option value="one">Grade One</option>
              <option value="two">Grade Two</option>
              <option value="three">Grade Three</option>
            </select>
          </div>
          <div class="textbox" style="margin-top:-1px;">
            <label for="section">
              Section
              <strong>*</strong>
            </label>
            <select id="section" class="inputbox">
              <option value="A">A</option>
              <option value="B">B</option>
            </select>
            <button class="searchButton" id="globalSearch">Search</button>
          </div>
          <div class="textarea">
            <label for="other">Search By Other Option</label>
            <textarea id="other" class="inputbox" placeholder="Search By Name,Nrc,..etc."></textarea>
            <button class="searchButton" id="globalSearch">Search</button>
          </div>
        </div>
      </div>
      <div class="sub-header" id="globalsubHeader">
        <button
          class="metaBtn tabTheme"
          id="listView"
          onclick="changeMega('listView','detailsView')"
          @click="listView()"
          style="margin-left:-20px;border-top-left-radius:3px;color:black;background:white;"
        >
          <i class="fa fa-list"></i> List View
        </button>
        <button
          class="metaBtn tabTheme"
          id="detailsView"
          onclick="changeMega('detailsView','listView')"
          @click="detailsView()"
        >
          <i class="fa fa-id-card"></i> Details View
        </button>
      </div>
      <div class="stucard-body" v-if="view === true">
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
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
        <div class="table-responsive">
          <table
            class="table table-hover table-striped table-bordered table-sm"
            id="selectedColumn"
          >
            <thead>
              <tr class="active" nowrap>
                <th nowrap class="th-sm">No.</th>
                <th nowrap class="th-sm">Name</th>
                <th nowrap class="th-sm">Photo</th>
                <th nowrap class="th-sm">Admission Number</th>
                <th nowrap class="th-sm">Roll Number</th>
                <th nowrap class="th-sm">Class</th>
                <th nowrap class="th-sm">Section</th>
                <th nowrap class="th-sm">Blood Group</th>
                <th nowrap class="th-sm">Height</th>
                <th nowrap class="th-sm">Weight</th>
                <th nowrap class="th-sm">Register Date</th>
                <th nowarp class="th-sm">AdmissionDate</th>
                <th nowrap class="th-sm">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active">
                <td nowrap>0</td>
                <td nowrap>Selena Gomez</td>
                <td nowrap>
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq2msisQfUdioeST-5wBrwuex4ZWEEjfGIZvxoSRLKrDk4UTGseg&s"
                    alt="student photo"
                  />
                </td>
                <td nowrap>1</td>
                <td nowrap>23</td>
                <td nowrap>Grade One</td>
                <td nowrap>Section A</td>
                <td nowrap>O+</td>
                <td nowrap>5ft</td>
                <td nowrap>134p</td>
                <td nowrap>09-09-2020</td>
                <td nowarp>30-06-2019</td>
                <td>
                  <router-link to="#">
                    <i class="fa fa-list"></i>
                  </router-link>
                  <router-link to="#">
                    <i class="fa fa-pencil pen"></i>
                  </router-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="stucard-body view" v-else>
        <div>
          <div class="infoFooter">
            <router-link to="#">
              <i class="fa fa-list-ul"></i>
            </router-link>
            <router-link to="#">
              <i class="fa fa-pencil pen"></i>
            </router-link>
          </div>
          <div class="row main">
            <div class="side">
              <img src="https://qph.fs.quoracdn.net/main-qimg-d171a30624492d6041d5b23548136440" alt />
            </div>
            <div class="right">
              <div class="row center">
                <div class="divcontent">
                  <strong class="key">Name</strong>
                  <strong class="value">: Gemine</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Admission Number</strong>
                  <strong class="value">: GR-0092</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Roll Number</strong>
                  <strong class="value">: EXF-20</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Class</strong>
                  <strong class="value">: Grade One</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Section</strong>
                  <strong class="value">: Section A</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Blood Group</strong>
                  <strong class="value">: O+</strong>
                </div>
              </div>
              <div class="row center">
                <div class="divcontent">
                  <strong class="key">Height</strong>
                  <strong class="value">: 5'6"</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Weight</strong>
                  <strong class="value">: 150 LB</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Register Date</strong>
                  <strong class="value">: 09-09-2019</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Admission Date</strong>
                  <strong class="value">: 09-09-2020</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Gender</strong>
                  <strong class="value">: Male</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Birth Date</strong>
                  <strong class="value">: 09-09-2000</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Religion</strong>
                  <strong class="value">: Buddish</strong>
                </div>
                <div class="divcontent">
                  <strong class="key">Mobile Number</strong>
                  <strong class="value">: 09779808035</strong>
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
      view: true,
      students: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    };
  },
  methods: {
    listView() {
      this.view = true;
    },
    detailsView() {
      this.view = false;
    }
  }
};
</script>