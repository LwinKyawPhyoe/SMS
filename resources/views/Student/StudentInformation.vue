<template>
  <div class="StudentInformation form" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link class="home" to="/Student">Home</router-link>> Student Details
      </h6>
    </div>
    <hr />
    <Loading></Loading>
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
            <select
              id="class"
              class="inputbox"
              @keyup="onValidate(class_id, 'class', 'class_msg')"
              v-on:blur="onValidate(class_id, 'class', 'class_msg')"
              @change="selectClass($event)"
              v-model="class_id"
            >
              <option selected disabled>Select Class</option>
              <option v-for="list in classList" :key="list.id" :value="list.id">{{list.class}}</option>
            </select>
            <span id="class_msg" class="error_message">Class reqiruired.</span>
          </div>
          <div class="textbox" style="margin-top:-1px;">
            <label for="section">
              Section
              <strong>*</strong>
            </label>
            <select
              id="section"
              class="inputbox"
              @keyup="onValidate(section_id, 'section', 'section_msg')"
              v-on:blur="onValidate(section_id, 'section', 'section_msg')"
              @change="selectSection($event)"
              v-model="section_id"
            >
              <option disabled selected>Select section</option>
              <option v-for="list in sectionList" :key="list.id" :value="list.id">{{list.section}}</option>
            </select>
            <span id="section_msg" class="error_message">Section required.</span>
            <button class="searchButton" id="globalSearch" @click="searchBySectionId()">Search</button>
          </div>
          <div class="textarea">
            <label for="other">Search By Keyword</label>
            <textarea
              id="other"
              class="inputbox"
              placeholder="Search By Name,Nrc,..etc."
              v-model="keyword"
            ></textarea>
            <button class="searchButton" id="globalSearch" @click="searchByKeyWord()">Search</button>
          </div>
        </div>
      </div>
      <div v-if="search">
        <div class="sub-header">
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
          <div v-if="studentList.length>0">
          <input type="text" placeholder="Search..." class="searchText" />
          <div class="copyRows">
            <div class="row" id="copyRow">
              <div class="col-3">
                <a href="#" title="PDF">
                  <i class="fa fa-file-pdf-o"></i>
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
            <table
              class="table table-hover table-striped table-sm"
              id="selectedColumn"
              
            >
              <thead>
                <tr class="active" nowrap>
                  <th nowrap class="th-sm">Admission Number</th>
                  <th nowrap class="th-sm">image</th>
                  <th nowrap class="th-sm">Class</th>
                  <th nowrap class="th-sm">Student Name</th>
                  <!-- <th nowrap class="th-sm">Class</th> -->
                  <th nowrap class="th-sm">Father Name</th>
                  <th nowrap class="th-sm">Mother Name</th>
                  <th nowrap class="th-sm">Guardian Name</th>
                  <th nowrap class="th-sm">Date Of Birth</th>
                  <th nowrap class="th-sm">Gender</th>
                  <th nowrap class="th-sm">Mobile Number</th>
                  <th nowrap class="th-sm">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="active" v-for="student in studentList" :key="student.id">
                  <td nowrap>{{student.admission_no}}</td>
                  <td nowrap v-if="student.image">
                    <img :src="'stu_image/'+student.image" alt="no image" />
                  </td>
                  <td v-else>
                    <img src="noimage.jpg" alt="no image" />
                  </td>
                  <td nowrap>{{student.class}}</td>
                  <td nowrap>{{student.name}}</td>
                  <!-- <td nowrap>
                  {{student.class}}
                  </td>-->
                  <td nowrap>{{student.father_name}}</td>
                  <td nowrap>{{student.mother_name}}</td>
                  <td nowrap>{{student.guardian_name}}</td>
                  <td nowrap>{{student.dob}}</td>
                  <td nowrap>{{student.gender}}</td>
                  <td nowrap>{{student.mobileno}}</td>
                  <td>
                    <router-link :to="{ name: 'viewstudent', params: { id: student.id }}">
                      <i class="fa fa-list"></i>
                    </router-link>
                    <router-link :to="{ name: 'editstudent', params: { id: student.id }}">
                      <i class="fa fa-pencil pen"></i>
                    </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
            
          </div>
          </div>
          <div v-else>
             <h1 class="NoData" style="margin-top:0px;">No Data</h1>
            </div>
        </div>
        <div class="stucard-body view" v-else>
          <div v-if="studentList.length>0">
            <div v-for="list in studentList" :key="list.id">
              <div class="infoFooter">
                <router-link :to="{ name: 'viewstudent', params: { id: list.id }}">
                  <i class="fa fa-list-ul"></i>
                </router-link>
                <router-link :to="{ name: 'editstudent', params: { id: list.id }}">
                  <i class="fa fa-pencil pen"></i>
                </router-link>
              </div>
              <div class="row main">
                <div class="side" v-if="list.image">
                  <img :src="'stu_image/'+list.image" />
                </div>
                <div class="side" v-else>
                  <img src="noimage.jpg" alt="noimage" />
                </div>
                <div class="right">
                  <div class="row center">
                    <div class="divcontent">
                      <h6>{{list.name}}</h6>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Class</strong>
                      <strong class="value">: {{list.class}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Admission Number</strong>
                      <strong class="value">: {{list.admission_no}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Date Of Birth</strong>
                      <strong class="value">: {{list.dob}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Gender</strong>
                      <strong class="value">: {{list.gender}}</strong>
                    </div>
                  </div>
                  <div class="row center">
                    <div class="divcontent">
                      <strong class="key">Father Name</strong>
                      <strong class="value">: {{list.father_name}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Mother Name</strong>
                      <strong class="value">: {{list.mother_name}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Guardian Name</strong>
                      <strong class="value">: {{list.guardian_name}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Guardian Phone</strong>
                      <strong class="value">: {{list.guardian_phone}}</strong>
                    </div>
                    <div class="divcontent">
                      <strong class="key">Current Address</strong>
                      <strong class="value">: {{list.current_address}}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
             <h1 class="NoData" style="margin-top:0px;">No Data</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../js/event-bus.js";
import Loading from "../LoadingController.vue";
export default {
  components: {
    Loading,
  },
  data() {
    return {
      viladition: true,
      view: true,
      students: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      search: false,
      classList: [],
      sectionList: [],
      section_id: "",
      class_id: "",
      class_section_id: "",
      keyword: "",
      studentList: [],
    };
  },
  created() {
    EventBus.$emit("ThemeClicked");
    this.allData();
  },
    mounted(){
    EventBus.$emit("onLoad");
  },

  methods: {
    searchByKeyWord() {
      EventBus.$emit("onLoad");
      this.search = false;
      if (this.keyword) {
        this.axios
          .get(`/api/student/keyword/${this.keyword}`)
          .then(response => {
            
            var student = response.data;
            console.log("-->" + JSON.stringify(student));
            var studentArray = [];
           

            console.log("student array" + JSON.stringify(studentArray));
            for (let i = 0; i < student.length; i++) {
              this.axios
                .get(
                  `/api/student/selectsection/${student[i].class_sections_id}`
                )
                .then(response1 => {
                  var classes =
                    response1.data.classes[0].class +
                    "(" +
                    response1.data.sections[0].section +
                    ")";
                  studentArray.push({
                    id: student[i].id,
                    admission_no: student[i].admission_no,
                    image: student[i].image,
                    name: student[i].name,
                    father_name: student[i].father_name,
                    mother_name: student[i].mother_name,
                    guardian_name: student[i].guardian_name,
                    dob: student[i].dob,
                    gender: student[i].gender,
                    class: classes,
                    mobileno: student[i].mobileno,
                    guardian_phone: student[i].guardian_phone,
                    current_address: student[i].current_address
                  });
                  // studentArray[i].id = student[i].id;
                  // studentArray[i].admission_no = student[i].admission_no;
                  // studentArray[i].image = student[i].image;
                  // studentArray[i].name = student[i].name;
                  // studentArray[i].father_name = student[i].father_name;
                  // studentArray[i].mother_name = student[i].mother_name;
                  // studentArray[i].guardian_name = student[i].guardian_name;
                  // studentArray[i].dob = student[i].dob;
                  // studentArray[i].gender = student[i].gender;
                  // studentArray[i].class = student[i].classes;
                  // studentArray[i].mobileno = student[i].mobileno;
                  // studentArray[i].guardian_phone = student[i].guardian_phone;
                  // studentArray[i].current_address = student[i].current_address;
                });
            }
            this.studentList = studentArray;
            EventBus.$emit("onLoadEnd");
          });
          
      }
      this.search = true;
      EventBus.$emit("ThemeClicked");
    },
    selectClass(e) {
      this.sectionList = [];
      this.section_id = "";
      var id = e.target.value;
      this.axios.get(`/api/student/section/${id}`).then(response => {
        this.sectionList = response.data;
      });
    },
    selectSection(e) {
      var id_section = e.target.value;
      var id_class = this.class_id;

      var array = [];
      this.axios
        .get(`/api/student/class_section/${id_class}/${id_section}`)
        .then(response => {
          array = response.data;
          this.class_section_id = array[0].id;
          console.log(this.class_section_id);
        });
    },
    allData() {
      this.axios.get("/api/student").then(response => {
        this.classList = response.data.class;
        EventBus.$emit("onLoadEnd");
      });
    },
    searchBySectionId() {
        EventBus.$emit("onLoad");
      this.search = false;
      this.formViladition();
      if (this.viladition == true) {
        EventBus.$emit("clicked");
        this.axios
          .get(`/api/student/sibling/${this.class_section_id}`)
          .then(response => {
            var student = response.data;
            var studentArray = [];
            console.log("student array" + JSON.stringify(studentArray));
            for (let i = 0; i < student.length; i++) {
              this.axios
                .get(
                  `/api/student/selectsection/${student[i].class_sections_id}`
                )
                .then(response1 => {
                  var classes =
                    response1.data.classes[0].class +
                    "(" +
                    response1.data.sections[0].section +
                    ")";
                  studentArray.push({
                    id: student[i].id,
                    admission_no: student[i].admission_no,
                    image: student[i].image,
                    name: student[i].name,
                    father_name: student[i].father_name,
                    mother_name: student[i].mother_name,
                    guardian_name: student[i].guardian_name,
                    dob: student[i].dob,
                    gender: student[i].gender,
                    class: classes,
                    mobileno: student[i].mobileno,
                    guardian_phone: student[i].guardian_phone,
                    current_address: student[i].current_address
                  });
                });

            }
             this.studentList = studentArray;
             EventBus.$emit("onLoadEnd");
          });
      }
      this.search = true;
      EventBus.$emit("ThemeClicked");
    },
    listView() {
      this.view = true;
    },
    detailsView() {
      this.view = false;
    },
    onValidate(value, inputId, megId) {
      if (value == "" || value == undefined)
        document.getElementById(inputId).style.border = "solid 1px red";
      else document.getElementById(inputId).style.border = "solid 1px #d2d6de";
      document.getElementById(megId).style.display = "none";
    },
    onValidationMessage(inputId, megId) {
      document.getElementById(inputId).style.border = "solid 1px red";
      document.getElementById(megId).style.display = "block";
    },
    formViladition() {
      this.viladition = true;
      if (!this.class_id) {
        this.onValidationMessage("class", "class_msg");
        this.viladition = false;
      }
      if (!this.section_id) {
        this.onValidationMessage("section", "section_msg");
        this.viladition = false;
      }
    }
  }
};
</script>