<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/dashboard" class="home">Home</router-link>>
        <router-link to="/examschadule" class="home">Exam Schedule</router-link>> Add Examinations
      </h4>
    </div>
    <hr />
    <Loading></Loading>
    <div class="card">
      <div class="card-header">
        <h6>Select Exam</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row">
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label>
              Exam name:
              <strong>*</strong>
            </label>
            <select class="inputbox" @change="getExamId($event)">
              <option>Select</option>
              <option :value="Exams.id" v-for="Exams in exams" :key="Exams.id">{{Exams.name}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label>
              Class
              <strong>*</strong>
            </label>
            <select class="inputbox" @change="getSection($event)">
              <option value>Select</option>
              <option :value="Class.id" v-for="Class in Class" :key="Class.id">{{Class.class}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label>
              Section
              <strong>*</strong>
            </label>
            <select class="inputbox" @change="getSectionId($event)">
              <option value>Select</option>
              <option
                :value="Sections.id"
                v-for="Sections in Sections"
                :key="Sections.id"
              >{{Sections.section}}</option>
            </select>
          </div>
          <div class="col-12 column-12">
            <button class="searchButton" id="globalSearch" @click="Search">Search</button>
          </div>
        </div>
      </div>
      <div class="sub-header" v-if="display == true">
        <h6>Exam Schedule</h6>
      </div>
      <div class="card-body" v-if="display == true">
        <div v-if="data == false">
          <h1 class="NoData">No Data</h1>
        </div>
        <div class="table-responsive" v-if="data == true">
          <table class="table table-hover table-striped">
            <thead>
              <th nowrap>Subject</th>
              <th nowrap>Date</th>
              <th nowrap>Start Time</th>
              <th nowrap>End Time</th>
              <th nowrap>Room</th>
              <th nowrap>Full Marks</th>
              <th nowrap>Passing Marks</th>
            </thead>
            <tbody>
              <tr v-for="n in mainExamSubjects" :key="n.id">
                <td>{{n.subject}}</td>
                <td>
                  <input type="date" v-model="n.date" />
                </td>
                <td>
                  <input type="time" v-model="n.start_time" />
                </td>
                <td>
                  <input type="time" v-model="n.end_time" />
                </td>
                <td>
                  <input class="inputbox" type="text" v-model="n.room" />
                </td>
                <td>
                  <input class="inputbox" type="text" v-model="n.full_marks" />
                </td>
                <td>
                  <input class="inputbox" type="text" v-model="n.passing_marks" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div>
          <button
            v-if="data == true"
            class="save"
            id="globalSave"
            style="margin:10px 1rem 1rem 0px"
            type="button"
            @click="saveExamSchadule()"
          >
            <router-link to style="color:white" class="submit">Submit</router-link>
          </button>
          <button v-if="data == false" class="save" id="globalSave" style="margin:10px 1rem 1rem 0px" type="button">
            <router-link to="examschadule" style="color:white" class="submit">Back</router-link>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import { EventBus } from "../../js/event-bus.js";
import store from "store2";
import Loading from "../LoadingController.vue";
export default {
  components: { DatePicker,Loading },
  data() {
    return {
      exams: [],
      id1: "",
      id2: "",
      id3: "",
      academicYearId: "",
      Sections: [],
      Class: [],
      arrayClassSectionExam: [],
      Subjects: [],
      check1: null,
      check2: null,
      SubjectName: [],
      SubjectNameS: [],
      mainExamSubjects: [],
      SaveExamSchadule: { examSchaduleObj: [] },
      message: "",
      display: false,
      data: false
    };
  },
  mounted(){
    EventBus.$emit('onLoad');
    this.getExamName();
    this.getClass();
  },
  created() {
    EventBus.$emit("ThemeClicked");
  },
  methods: {
    getClass() {
      this.axios.get(`/api/getClasses`).then(response => {
        this.Class = response.data;
        EventBus.$emit('onLoadEnd');
      });
    },
    getExamName() {
      this.axios.get("/api/ExamList").then(response => {
        this.exams = response.data;
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
      this.id3 = eventS.target.value;
      this.display = false;
    },
    getExamId(event) {
      this.id1 = event.target.value;
      this.display = false;
    },
    Search() {
      EventBus.$emit('onLoad');
      this.mainExamSubjects = [];
      this.arrayClassSectionExam.push(this.id1);
      this.arrayClassSectionExam.push(this.id2);
      this.arrayClassSectionExam.push(this.id3);
      this.axios
        .get(`/api/searchExamSchadule/${this.arrayClassSectionExam}`)
        .then(response => {
          // this.Subjects = response.data;
          this.mainExamSubjects = response.data;
          this.arrayClassSectionExam = [];
          var dataValue;
        EventBus.$emit("ThemeClicked");
        for (var i = 0; i < this.mainExamSubjects.length; i++) {
          dataValue = this.mainExamSubjects[i].subject;
        }
        if (dataValue == undefined) {
          this.data = false;
        } else {
          this.data = true;
        }
        EventBus.$emit('onLoadEnd');
        this.display = true;
        });
    },
    allData() {
      for (var i = 0; i < this.mainExamSubjects.length; i++) {
        this.SaveExamSchadule.examSchaduleObj.push({
          session_id: "",
          exam_id: this.id1,
          assign_subject_id: this.mainExamSubjects[i].id,
          date_of_exam: this.mainExamSubjects[i].date,
          start_time: this.mainExamSubjects[i].start_time,
          end_time: this.mainExamSubjects[i].end_time,
          room_no: this.mainExamSubjects[i].room,
          full_marks: this.mainExamSubjects[i].full_marks,
          passing_marks: this.mainExamSubjects[i].passing_marks,
          note: "no",
          is_active: "yes",
          domain: "TS"
        });
      }
    },
    saveExamSchadule() {
      this.allData();
      this.axios
        .post(`/api/examSchadules/addExamSchadule`, this.SaveExamSchadule)
        .then(response => {
          this.message = response.data;
          this.$router.push({name:'examschadule'})
        });
        store.set("msg","save");
    }
  }
};
</script>