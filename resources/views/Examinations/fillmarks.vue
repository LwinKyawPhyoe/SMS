<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>>
        <router-link to="/MarkRegister" class="home">Marks Register</router-link>> Add Fill Marks
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Fill Marks</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">
              Exam Name
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class" @change="setExamId($event)">
              <option>Select</option>
              <option
                v-for="examNames in examNames"
                :key="examNames.id"
                :value="examNames.id"
              >{{examNames.name}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">
              Class
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class" @change="getSection($event)">
              <option>Select</option>
              <option
                v-for="Classes in Classes"
                :key="Classes.id"
                :value="Classes.id"
              >{{Classes.class}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">Section</label>
            <select class="inputbox" @change="getSectionId($event)">
              <option>Select Section</option>
              <option
                v-for="Sections in Sections"
                :key="Sections.id"
                :value="Sections.id"
              >{{Sections.section}}</option>
            </select>
          </div>
          <div class="col-12 column-12">
            <button class="searchButton" id="globalSearch" @click="Search()">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header" v-if="this.display == true">
        <h6>Fill Marks</h6>
      </div>
      <div class="card-body" v-if="this.display == true">
        <div v-if="this.data == false">
          <h1 class="NoData">No Data</h1>
        </div>
        <div class="table-responsive" v-if="this.data == true">
          <table
            class="table table-hover table-striped"
            style="display: block;overflow-y: auto;"
            id="studenttable"
          >
            <thead>
              <tr style="font-size:14px;">
                <th class="all" nowrap>Adminission Number</th>
                <th class="all" nowrap>Roll Number</th>
                <th class="all" nowrap>Student</th>
                <th
                  class="all"
                  nowrap
                  v-for="tablehead in tableHead"
                  :key="tablehead.id"
                >
                <label v-if="tablehead.passing_marks > 0" for="" style="margin:0">{{tablehead.subject}} (TH:{{tablehead.passing_marks}}/{{tablehead.full_marks}})</label>
                <label v-else for="" style="margin:0">{{tablehead.subject}} <i
                  class="fa fa-times"
                  style="color:red; margin-left:10px;"
                ></i></label>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="active"
                style="border-bottom: 1px solid #ebebeb;"
                v-for="(studentExam,index) in StudentExam"
                :key="studentExam.id"
              >
                <td class="all" nowrap>{{studentExam.admission_no}}</td>
                <td class="all" nowrap>{{studentExam.roll_no}}</td>
                <td class="all" nowrap>{{studentExam.student_name}}</td>
                <td v-for="Subjects in studentExam.subjects" :key="Subjects.id">
                  <div class="form-group">
                    <div class="checkbox">
                      <label class="checkLabel">
                        <input
                          v-if="Subjects.start_time == 'A'"
                          :checked="true"
                          type="checkbox"
                          value="A"
                          autocomplete="off"
                          @click="checkA($event,Subjects)"
                        />
                        <input
                        disabled
                         v-else-if="Subjects.passing_marks == null"
                          type="checkbox"
                          value="A"
                          autocomplete="off"
                        />
                        <input
                          v-else
                          type="checkbox"
                          value="A"
                          autocomplete="off"
                          @click="checkA($event,Subjects)"
                        />
                        Abs
                      </label>
                    </div>
                    <input type="hidden" name="subject_id" value="1" />
                    <input
                      v-if="Subjects.start_time == 'A'"
                      disabled
                      type="number"
                      class="inputbox"
                      placeholder="Enter Marks"
                      v-model="Subjects.note"
                    />
                    <input
                      v-else-if="Subjects.passing_marks == null"
                      disabled
                      type="number"
                      class="inputbox"
                      placeholder="No Exam"
                      v-model="Subjects.note"
                    />
                    <input
                      v-else
                      type="number"
                      class="inputbox"
                      placeholder="Enter Marks"
                      v-on:keyup="checkFullMarks($event,Subjects.full_marks,Subjects.id+index)"
                      v-model="Subjects.note"
                    />
                    <span :id="Subjects.id+index" class="error_message">More than full marks.</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <button class="save" id="globalSave" @click="SaveExamResults()">Save</button>
        </div>
      </div>
    </div>
    <!-- <button type="button" @click="Test()">TEST</button> -->
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
import store from "store2";
export default {
  data() {
    return {
      examNames: [],
      Classes: [],
      Sections: [],
      idsArray: [],
      id1: "",
      id2: "",
      id3: "",
      tableHead: [],
      StudentExam: [],
      display: false,
      ExamResults: { examResults: [] },
      data: false,
      Absent: false,
      oldValue: "0",
      oldId: ""
    };
  },
  created() {
    EventBus.$emit("ThemeClicked");
    this.getExamNames();
    this.getClass();
  },
  methods: {
    getExamNames() {
      this.axios.get(`/api/ExamList`).then(respnonse => {
        this.examNames = respnonse.data;
      });
    },
    setExamId(event) {
      this.id1 = event.target.value;
      this.display = false;
    },
    getClass() {
      this.axios.get(`/api/getClasses`).then(response => {
        this.Classes = response.data;
      });
    },
    getSection(event) {
      this.axios
        .get(`/api/getClassSection/${event.target.value}`)
        .then(response => {
          this.Sections = response.data;
          this.id2 = event.target.value;
          this.display = false;
        });
    },
    getSectionId(eventS) {
      this.display = false;
      this.id3 = eventS.target.value;
    },
    getAllData() {
      for (var i = 0; i < this.StudentExam.length; i++) {
        for (var ii = 0; ii < this.StudentExam[i].subjects.length; ii++) {
          this.ExamResults.examResults.push({
            attendence: this.StudentExam[i].subjects[ii].start_time,
            exam_schadule_id: this.StudentExam[i].subjects[ii].id,
            admission_no: this.StudentExam[i].admission_no,
            get_marks: this.StudentExam[i].subjects[ii].note
          });
        }
      }
    },
    Search() {
      this.idsArray.push(this.id1);
      this.idsArray.push(this.id2);
      this.idsArray.push(this.id3);
      this.axios
        .get(`/api/marksGrade/getSearchData/${this.idsArray}`)
        .then(response => {
          this.tableHead = response.data;
        });
      this.axios
        .get(`/api/marksGrade/getStudentExam/${this.idsArray}`)
        .then(response => {
          if (response.data == "no data") {
            this.data = false;
          } else {
            this.data = true;
            this.StudentExam = response.data;
          }
        });
      this.idsArray = [];
      setTimeout(() => {
        EventBus.$emit("ThemeClicked");
        this.display = true;
      }, 1000);
    },
    Test() {},
    SaveExamResults() {
      this.getAllData();
      this.axios
        .post(`/api/examResults/addExamResults`, this.ExamResults)
        .then(response => {
          this.$router.push({ name: "MarkRegister" });
        });
        store.set("msg","save");
    },
    checkA(event, Obj) {
      if (event.target.checked) {
        Obj.start_time = event.target.value;
        this.oldValue = Obj.note;
        Obj.note = "0";
        this.oldId = Obj.id;
      } else {
        Obj.start_time = "yes";

        if (Obj.id == this.oldId) {
          Obj.note = this.oldValue;
        } else {
          Obj.note = "0";
          this.oldId = Obj.id;
        }
      }
    },
    checkFullMarks(event, full_marks, warm) {
      var getMarks = parseInt(event.target.value);
      var fullMarks = parseInt(full_marks);
      if (fullMarks < getMarks) {
        document.getElementById(warm).style.display = "block";
      } else {
        document.getElementById(warm).style.display = "none";
      }
    }
  }
};
</script>