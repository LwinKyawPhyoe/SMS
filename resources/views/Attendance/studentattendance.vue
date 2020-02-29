<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Attendance</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Student Attendance
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Attendance</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Class
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Class</option>
              <option value="Class A">Class A</option>
              <option value="Class B">Class B</option>
              <option value="Class C">Class C</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name" class="title">
              Section
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class">
              <option selected disabled>Select Section</option>
              <option value="Section A">Section A</option>
              <option value="Section B">Section B</option>
              <option value="Section C">Section C</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="name">Attendance Date</label>
            <input type="date" class="inputbox" v-model="date" />
          </div>
          <div class="col-12 column-12">
            <button class="searchButton" id="globalSearch" @click="search(date)">Search</button>
          </div>
        </div>
      </div>

      <div class="sub-header">
        <h6>Student List</h6>
      </div>
      <div class="card-body">
        <label class="btn btn-dark">
          <input type="checkbox" style="margin-right:5px;" /> Mark as holiday
        </label>
        <button
          type="submit"
          @click="Save()"
          style="outline:none;float:right;"
          class="btn btn-dark"
        >Save Attendance</button>
        <div class="row" id="row" style="width:100%;">
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>No</th>
                  <th class="all" nowrap>Admmision Number</th>
                  <th class="all" nowrap>Name</th>
                  <th class="all" nowrap>Attendance</th>
                  <th class="all" nowrap>Note</th>
                </tr>
              </thead>
              <tbody>
                <tr class="active" v-for="n in student" :key="n.studentid">
                  <td class="all" nowrap>{{n.studentid}}</td>
                  <td class="all" nowrap>{{n.admission_no}}</td>
                  <td class="all" nowrap>{{n.name}}</td>
                  <td class="all" nowrap>
                    <span
                      v-for="(type) in attendance_type"
                      :key="type.id"
                      style="margin-right:10px;"
                    >
                      <input
                        type="radio"
                        :value="type.type"
                        :id="n.studentid+type.type"
                        :name="n.studentid"
                        checked
                        @click="pushByRadio($event,type.id,n.admission_no)"
                      />
                      <label :for="n.studentid+type.type">{{type.type}}</label>
                    </span>
                  </td>
                  <td>
                    <input type="text" name="note" class="note" v-model="n.note" />
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
import { EventBus } from "../../js/event-bus.js";
export default {
  data() {
    return {
      attendance_type: [],
      student: [
        {
          studentid: "1",
          admission_no: "1001",
          name: "Gemine",
          is_active: "yes",
          note: "",
          attendance: ""
        },
        {
          studentid: "2",
          admission_no: "1002",
          name: "Thein Gyi",
          is_active: "yes",
          note: "",
          attendance: ""
        },
        {
          studentid: "3",
          admission_no: "1003",
          name: "Sai Kaung Htet",
          is_active: "yes",
          note: "",
          attendance: ""
        },
        {
          studentid: "4",
          admission_no: "1004",
          name: "MyatMin",
          is_active: "yes",
          note: "",
          attendance: ""
        },
        {
          studentid: "5",
          admission_no: "1005",
          name: "TharHtoo",
          is_active: "yes",
          note: "",
          attendance: ""
        }
      ],
      holiday: false,
      student_attendance: { studObj: [] },
      // student_attendance:[],
      date: "",
      note: ""
    };
  },
  created() {
    EventBus.$emit("clicked");
    this.axios.get("/api/attendancetypes").then(response => {
      this.attendance_type = response.data;
      console.log(JSON.stringify(response.data));
      for (let i = 0; i < this.student.length; i++) {
        this.student[i].attendance = this.attendance_type[
          this.attendance_type.length - 1
        ].id;
        // this.student_attendance.push({admission_no:this.student[i].admission_no,date:this.date,attendance_type_id:this.student[i].attendance,biometric_attendence:'-',remark:this.student[i].note,is_active:'yes'})
      }
      console.log(JSON.stringify(this.student_attendance));
    });
  },
  methods: {
    holiday(env) {
      if (env.target.checked) {
        this.holiday = true;
      } else {
        this.holiday = false;
      }
    },
    pushByRadio(env, AttID, adm_no) {
      // console.log(env.target.checked + "++++++" + AttID + "+++++" + adm_no);
      if (env.target.checked) {
        for (let i = 0; i < this.student.length; i++) {
          if (adm_no == this.student[i].admission_no) {
            this.student[i].attendance = AttID;
            break;
          }
          // this.student[i].attendance_type_id = AttID;
        }
      }
      console.log(JSON.stringify(this.student));
    },
    allData() {
      console.log("----->>>" + JSON.stringify(this.student));
      for (let i = 0; i < this.student.length; i++) {
        // this.student_attendance[i].date = this.date;
        // this.student_attendance[i].remark = this.student[i].note;
        this.student_attendance.studObj.push({
          admission_no: this.student[i].admission_no,
          date: this.date,
          attendance_type_id: this.student[i].attendance,
          biometric_attendance: "-",
          remark: this.student[i].note,
          is_active: "yes"
        });
        // this.student_attendance[i].attendance_type_id = this.student[i].type;
      }
    },
    add() {
      if (this.student_attendance != null || this.student_attendance != []) {
        this.allData();
        console.log(JSON.stringify(this.student_attendance));
        this.axios
          .post("/api/studentattendance/add", this.student_attendance)
          .then(response => {
            // console.log(response);
            console.log("----> " + JSON.stringify(response.data));
          })
          .catch(error => {
            console.log("err->" + JSON.stringify(this.error.response));
          });
        this.student_attendance = [];
        this.student = [];
        this.date = null;
      } else {
        alert("Search Some Student.");
      }
    },
    Save() {},
    search(todaydate) {
      this.date = todaydate;
      this.axios
        .get("/api/studentattendance/show/" + todaydate, todaydate)
        .then(response => {
          // alert(JSON.stringify(response.data))
          // console.log(response);
          // console.log('data',JSON.stringify(response.data));
          this.student = response.data;
        })
        .catch(error => [console.log(error)]);
    }
  }
};
</script>