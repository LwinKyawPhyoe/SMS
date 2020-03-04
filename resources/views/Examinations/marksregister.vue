<template>
  <div class="form" id="bar">
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width:653px;">
          <div class="modal-body" style="padding:0;">
            <div class="card-header" style="width: 100%;margin-left: 0;">
              <h6>Examinations</h6>
            </div>
            <div style="padding:10px 0px 0px 0px;">
              <div style="font-weight:bold;margin-left:18px">
                Student Name: {{Student_name}}
                <br />
                Admission_no: {{Admission_number}}
                <br />
                Roll_Number : {{Roll_number}}
              </div>
              <div class="table-responsive" style="margin-top: 15px;">
                <table
                  class="table table-hover table-striped"
                  style="display: block;overflow-y: auto;"
                  id="studenttable"
                >
                  <thead>
                    <tr style="font-size:14px;">
                      <th
                        class="all"
                        nowrap
                        v-for="tablehead in tableHead"
                        :key="tablehead.id"
                      > <label for="" v-if="tablehead.passing_marks > 0" style="margin:0">{{tablehead.subject}} (TH:{{tablehead.passing_marks}}/{{tablehead.full_marks}})</label>
                        <label for="" v-else style="margin:0">{{tablehead.subject}} <i
                  class="fa fa-times"
                  style="color:red; margin-left:10px;"
                ></i></label>
                       </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                      <td
                        v-for="(editStudentExam,index) in editStudentExamData"
                        :key="editStudentExam.id"
                      >
                        <div class="form-group">
                          <div class="checkbox">
                            <label class="checkLabel">
                              <input
                                v-if="editStudentExam.attendence == 'A'"
                                type="checkbox"
                                :checked="true"
                                value="A"
                                autocomplete="off"
                                @click="checkA($event,editStudentExam)"
                              />
                              <input
                                v-else-if="editStudentExam.get_marks == null || editStudentExam.get_marks == 'No Marks'"
                                type="checkbox"
                                disabled
                                value="A"
                                autocomplete="off"
                              />
                              <input
                                v-else
                                type="checkbox"
                                value="A"
                                autocomplete="off"
                                @click="checkA($event,editStudentExam)"
                              />
                              Abs
                            </label>
                          </div>
                          <input type="hidden" name="subject_id" value="1" />
                          <input
                            v-if="editStudentExam.attendence == 'A'"
                            disabled
                            type="text"
                            class="inputbox"
                            placeholder="Enter Marks"
                            v-model="editStudentExam.get_marks"
                          />
                          <input
                            v-else-if="editStudentExam.get_marks == null || editStudentExam.get_marks == 'No Marks'"
                            disabled
                            type="text"
                            class="inputbox"
                            placeholder="No Data"
                          />
                          <input
                            v-on:keyup="checkFullMarks($event,editStudentExam.full_marks,index)"
                            v-else
                            type="number"
                            class="inputbox"
                            placeholder="Enter Marks"
                            v-model="editStudentExam.get_marks"
                          />
                          <span :id="index" class="error_message">More than full marks.</span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="globalSearch" class="save" data-dismiss="modal" @click="Edit()">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Marks Register
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Marks Register</h6>
        <router-link to="/fillmarks" onclick="showForm()" class="add">Add</router-link>
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
            <select class="inputbox" name="class" @change="getSectionId($event)">
              <option selected>Select</option>
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
        <h6>Marks Register</h6>
      </div>
      <div class="card-body" v-if="this.display == true">
        <input
          v-on:keyup="searchTable()"
          type="text"
          placeholder="Search..."
          class="searchText"
          id="myInput"
        />
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
        <div v-if="this.data == false">
          <h1 class="NoData">No Data</h1>
        </div>
        <div class="table-responsive" v-if="this.data == true">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr style="font-size:14px;">
                <th class="all" nowrap>Adminission Number</th>
                <th class="all" nowrap>Roll Number</th>
                <th class="all" nowrap>Student</th>
                <th class="all" nowrap>Father Name</th>
                <th
                  class="all"
                  nowrap
                  v-for="tablehead in tableHead"
                  :key="tablehead.id"
                > <label v-if="tablehead.passing_marks > 0" for="" style="margin:0">{{tablehead.subject}} (TH:{{tablehead.passing_marks}}/{{tablehead.full_marks}})</label>
                  <label v-else for="" style="margin:0">{{tablehead.subject}} <i
                  class="fa fa-times"
                  style="color:red; margin-left:10px;"
                ></i></label>
                 </th>
                <th class="all" nowrap>Grade Total</th>
                <th class="all" nowrap>Percent(%)</th>
                <th class="all" nowrap>Result</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <tr
                class="active"
                v-for="StudentExam in this.tableBodyStudentExam"
                :key="StudentExam.id"
              >
                <td class="all" nowrap>{{StudentExam.admission_no}}</td>
                <td class="all" nowrap>{{StudentExam.roll_number}}</td>
                <td class="all" nowrap>{{StudentExam.student_name}}</td>
                <td class="all" nowrap>{{StudentExam.father_name}}</td>
                <td
                  class="all"
                  nowrap
                  v-for="ExamSubjects in StudentExam.subjects"
                  :key="ExamSubjects.id"
                >
                  <label for v-if="ExamSubjects.attendence == 'A'" style="margin-bottom:0px">{{ExamSubjects.attendence}}</label>
                  <label for v-else-if="ExamSubjects.get_marks == null || ExamSubjects.get_marks == 'No Marks'" style="margin-bottom:0">No Marks</label>
                  <label for v-else style="margin-bottom:0px">{{ExamSubjects.get_marks}}</label>
                </td>
                <td class="all" nowrap>{{StudentExam.grand_total}}/{{grandTotal}}</td>
                <td class="all" nowrap>{{StudentExam.percent}} %</td>
                <td class="all" nowrap>
                  <a
                    v-if="StudentExam.Result == 'pass'"
                    href="#"
                    style="text-decoration:none;"
                    class="btn-success btn-sm"
                  >{{StudentExam.Result}}</a>
                  <a
                    v-if="StudentExam.Result == 'failed'"
                    href="#"
                    style="text-decoration:none;" 
                    class="btn-danger btn-sm"
                  >{{StudentExam.Result}}</a>
                </td>
                <td>
                  <i
                    class="fa fa-pencil pen"
                    @click="EditStudentExam(StudentExam)"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                  >
                    <span class="penLabel">Edit</span>
                  </i>
                </td>
              </tr>
            </tbody>
          </table>
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
      examNames: [],
      Classes: [],
      Sections: [],
      idsArray: [],
      tableHead: [],
      id1: "",
      id2: "",
      id3: "",
      display: false,
      grandTotal: 0,
      tableBodyStudentExam: [],
      editStudentExamData: [],
      editExmaResult: { Examresult: [] },
      Student_name: "",
      Roll_number: "",
      Admission_number: "",
      successMessage: "",
      oneStudentObj: [],
      data: false,
      Result: "",
      oldId: "",
      oldValue: "",
      oldNumber: ""
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
    Search() {
      this.idsArray = [];
      this.idsArray.push(this.id1);
      this.idsArray.push(this.id2);
      this.idsArray.push(this.id3);
      this.axios
        .get(`/api/marksGrade/getSearchData/${this.idsArray}`)
        .then(response => {
          this.tableHead = response.data;
          var ReturnData = response.data;
          var TotalMarks = 0;
          for (var i = 0; i < ReturnData.length; i++) {
            if(ReturnData[i].full_marks != null){
              TotalMarks = TotalMarks + parseInt(ReturnData[i].full_marks);
            }
          }
          this.grandTotal = TotalMarks;
        });
      this.axios
        .get(`/api/examResults/getExamResultData/${this.idsArray}`)
        .then(response => {
          if (response.data == "no data") {
            this.data = false;
          } else {
            this.data = true;
            this.tableBodyStudentExam = response.data;
          }
        });
      setTimeout(() => {
        this.display = true;
      }, 1000);
    },
    searchTable() {
      var input, filter, found, table, tr, td, i, j;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
            found = true;
          }
        }
        if (found) {
          tr[i].style.display = "";
          found = false;
        } else {
          tr[i].style.display = "none";
        }
      }
    },
    EditStudentExam(StudentExam) {
      this.oneStudentObj = StudentExam;
      this.Student_name = StudentExam.student_name;
      this.Roll_number = StudentExam.roll_number;
      this.Admission_number = StudentExam.admission_no;
      this.editStudentExamData = StudentExam.subjects;
      this.OldStudentExamObj = StudentExam.subjects;
    },
    getAllData() {
      for (var i = 0; i < this.editStudentExamData.length; i++) {
        // console.log(this.editStudentExamData[i].exam_schadule_id);
        this.editExmaResult.Examresult.push({
          admission_no: this.Admission_number,
          exam_schadule_id: this.editStudentExamData[i].exam_schadule_id,
          get_marks: this.editStudentExamData[i].get_marks,
          attendence: this.editStudentExamData[i].attendence
        });
      }
    },
    Edit() {
      this.getAllData();
      this.axios
        .post(`/api/examResults/editExamResult/`, this.editExmaResult)
        .then(response => {
          this.successMessage = response.data;
        });
      var changeTotal = 0;
      var changeResult = "pass";
      for (var i = 0; i < this.editStudentExamData.length; i++) {
          if(this.editStudentExamData[i].get_marks != null){
            changeTotal =
          changeTotal + parseInt(this.editStudentExamData[i].get_marks);
          }
        if (
          this.editStudentExamData[i].get_marks <
          this.editStudentExamData[i].passing_marks
        ) {
          changeResult = "failed";
        }
      }
      var changePercent = (changeTotal / this.grandTotal) * 100;
      this.oneStudentObj.grand_total = changeTotal;
      this.oneStudentObj.percent = changePercent.toString().substring(0, 4);
      this.oneStudentObj.Result = changeResult;
      setTimeout(() => {
        this.editStudentExamData = [];
      }, 1000);
    },
    checkA(event, Obj) {
      if (event.target.checked) {
        Obj.attendence = event.target.value;
        Obj.get_marks = 0;
      } else {
        Obj.attendence = "yes";
      }
    },
    checkA(event, Obj) {
      if (event.target.checked) {
        Obj.attendence = event.target.value;
        this.oldValue = Obj.get_marks;
        Obj.get_marks = "0";
        this.oldId = Obj.id;
      } else {
        Obj.attendence = "yes";

        if (Obj.id == this.oldId) {
          Obj.get_marks = this.oldValue;
        } else {
          Obj.get_marks = "0";
          this.oldId = Obj.id;
        }
      }
    },
    checkFullMarks(event, full_marks, warm) {
      var fullMarks = parseInt(full_marks);
      var getMarks = parseInt(event.target.value);
      setTimeout(() => {
        if (fullMarks < getMarks) {
          document.getElementById(warm).style.display = "block";
        } else {
          document.getElementById(warm).style.display = "none";
        }
      }, 300);
    }
  }
};
</script>