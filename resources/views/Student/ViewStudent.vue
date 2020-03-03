<template>
  <div class="ViewStudent form" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link to="/Student">Home</router-link>> Student Information
      </h6>
    </div>
    <hr />
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"
        style="background:none;border:none;width:100% !important;padding: 1rem;"
        >
            <div class="card-header">
              <h6 style="width:100%;vertical-align: middle;">
                Upload Document
                <i
                  class="fa fa-times"
                  style="float:right;margin-right:10px;cursor:pointer;padding:5px;"
                  data-dismiss="modal"
                ></i>
              </h6>
            </div>
            <div class="card-body">
              <div class="row">
              <div class="modalinput">
                <label for="class">
                  Title
                </label>
                <input type="text" class="inputbox" id="class" v-model="documentData.document_title"/>
              </div>
              <div class="modalinput">
                <input type="file" id="section" class="inputbox" @change="onFileChange($event)" />
              </div>
              <div style="width:100%;">
                <button class="modalbtn" style="text-align:center;" @click="addDocument()" id="btnsave" data-dismiss="modal">Save</button>
              </div>
            </div>
              </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-12">
        <div class="card" style="height:fit-content;">
          <div class="card-header">
            <h6>Student Profile</h6>
          </div>
          <div class="card-body">
            <div class="student">
              <div class="container">
                <img v-if="student.image" :src="'stu_image/'+student.image"/>
                <img src="noimage.jpg" v-else>
              </div>
              <h4>{{student.name}}</h4>
              <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Admission Number</b></td>
                    <td class="all" nowrap>{{student.admission_no}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Roll Number</b></td>
                    <td class="all" nowrap>{{student.roll_no}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Class</b></td>
                    <td class="all" nowrap>{{class_id}}</td>
                  </tr>

                  <tr>
                    <td class="all" nowrap><b>Section</b></td>
                    <td class="all" nowrap>{{section_id}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Gender</b></td>
                    <td class="all" nowrap>{{student.gender}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
          </div>
          <div class="sub-header" v-if="sibling">
            <h6>Siblings Information</h6>
          </div>
          <div class="card-body" v-if="sibling">
            <div class="sibling">
              <div class="container">
                <img :src="'stu_image/'+sibling.image" v-if="sibling.image"/>
                <img src="noimage.jpg" v-else>
                <h4>{{sibling.name}}</h4>
              </div>
              <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Admission Number</b></td>
                    <td class="all" nowrap>{{sibling.admission_no}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Class</b></td>
                    <td class="all" nowrap>{{sibling_class_id}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Section</b></td>
                    <td class="all" nowrap>{{sibling_section_id}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Gender</b></td>
                    <td class="all" nowrap>{{sibling.gender}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-12">
        <div class="card remains">
          <div class="card-header">
            <button
              class="metaBtn"
              id="profile"
              onclick="toggleBtn('profile','exam','document','timeline')"
              @click="showData('profile')"
              style="margin-left:-20px;border-top-left-radius:3px;background-color: white;color: black;"
            >
               Profile
            </button>
            <button
              class="metaBtn"
              id="exam"
              onclick="toggleBtn('exam','profile','document','timeline')"
              @click="showData('exam')"
            >
              Exam
            </button>
            <button
              class="metaBtn"
              id="document"
              onclick="toggleBtn('document','exam','profile','timeline')"
              @click="showData('document')"
            >
              Document
            </button>
            <button
              class="metaBtn"
              id="timeline"
              onclick="toggleBtn('timeline','exam','profile','document')"
              @click="showData('timeline')"
            >
              Timeline
            </button>
          </div>
          <div class="card-body profile" v-if="profile===true">
            <div class="card-body" style="margin-top:10px;">
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Admission Date</b></td>
                    <td class="all" nowrap>{{student.admission_date}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Date of Birth</b></td>
                    <td class="all" nowrap>{{student.dob}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Mobile Number</b></td>
                    <td class="all" nowrap>{{student.mobileno}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Religion</b></td>
                    <td class="all" nowrap>{{student.religion}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Race</b></td>
                    <td class="all" nowrap>{{student.race}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Student Email</b></td>
                    <td class="all" nowrap>{{student.email}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>

            <div class="sub-header">
              <h6>Address Details</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Current Address</b></td>
                    <td class="all" nowrap>{{student.current_address}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Permanent Address</b></td>
                    <td class="all" nowrap>{{student.permanent_address}}</td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
            <div class="sub-header">
              <h6>Parents/Guardian Address</h6>
            </div>
            <div class="card-body parents">
              <div class="row">
                <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Father Name</b></td>
                    <td class="all" nowrap>{{student.father_name}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Father Phone</b></td>
                    <td class="all" nowrap>{{student.father_phone}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Father Job</b></td>
                    <td class="all" nowrap>{{student.father_job}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Father NRC.</b></td>
                    <td class="all" nowrap>{{student.father_job}}</td>
                  </tr>
                </tbody>
              </table>
              </div>
                <div class="container">
                  <img :src="'father_image/'+student.father_photo" class="img-responsive" v-if="student.father_photo"/>
                  <img src="noimage.jpg" class="img-responsive" v-else/>
                </div>
              </div>
              <div class="row">
                <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Mother Name</b></td>
                    <td class="all" nowrap>{{student.mother_name}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Mother Phone</b></td>
                    <td class="all" nowrap>{{student.mother_phone}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Mother Job</b></td>
                    <td class="all" nowrap>{{student.mother_job}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Mother NRC.</b></td>
                    <td class="all" nowrap>{{student.mother_nrc}}</td>
                  </tr>
                </tbody>
              </table>
              </div>
                <div class="container">
                  <img :src="'mother_image/'+student.mother_photo" class="img-responsive" v-if="student.mother_photo"/>
                  <img src="noimage.jpg" class="img-responsive" v-else/>
                </div>
              </div>
              <div class="row">
                <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Guardian Name</b></td>
                    <td class="all" nowrap>{{student.guardian_name}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Guardian Phone</b></td>
                    <td class="all" nowrap>{{student.guardian_phone}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Guardian Relation</b></td>
                    <td class="all" nowrap>{{student.guardian_relation}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Guardian Email</b></td>
                    <td class="all" nowrap>{{student.guardian_email}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Guardian Job</b></td>
                    <td class="all" nowrap>{{student.guardian_job}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Guardian NRC.</b></td>
                    <td class="all" nowrap>{{student.guardian_nrc}}</td>
                  </tr>
                </tbody>
              </table>
              </div>
                <div class="container">
                  <img :src="'guardian_image/'+student.guardian_photo" class="img-responsive" v-if="student.guardian_photo"/>
                  <img src="noimage.jpg" class="img-responsive" v-else/>
                </div>
              </div>
            </div>
            <div class="sub-header">
              <h6>Miscellaneous Details</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-sm">
                <tbody>
                  <tr>
                    <td class="all" nowrap><b>Blood Group</b></td>
                    <td class="all" nowrap>{{student.blood_group}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Height</b></td>
                    <td class="all" nowrap>{{student.height}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Weight</b></td>
                    <td class="all" nowrap>{{student.weight}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Register Date</b></td>
                    <td class="all" nowrap>{{student.register_date}}</td>
                  </tr>
                  <tr>
                    <td class="all" nowrap><b>Previous School</b></td>
                    <td class="all" nowrap>{{student.previous_school}}</td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
          <div class="card-body exam profile" v-if="exam===true">
            <div v-if="studentExam == 0" style="margin-top:0px;">
              <h1 class="NoData" >No Data</h1>
            </div>
            <div v-else>
              <div v-for="StudentExam in studentExam" :key="StudentExam.name">
              <div class="sub-header" style="background:black;">
              <h6>{{StudentExam.name}}</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
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
                <table class="table table-hover table-striped" id="studenttable">
                  <thead>
                    <tr role="row">
                      <th class="all" nowrap>No</th>
                      <th class="all" nowrap>Subject</th>
                      <th class="all" nowrap>Full Marks</th>
                      <th class="all" nowrap>Passing Marks</th>
                      <th class="all" nowrap>Obtain Marks</th>
                      <th class="all" nowrap>Result</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="active" v-for="(subjects,index) in StudentExam.exam_data" :key="subjects.subjects_name">
                      <td class="all" nowrap> {{index + 1}} </td>
                      <td class="all" nowrap>{{subjects.subject_name}}</td>
                      <td class="all" nowrap>{{subjects.full_marks}}</td>
                      <td class="all" nowrap>{{subjects.passing_marks}}</td>
                      <td class="all" nowrap>{{subjects.get_marks}}</td>
                      <td class="all" nowrap>
                        <a v-if="subjects.result == 'failed'" style="text-decoration:none;color:white" class="btn-danger btn-sm">Fail</a>
                        <a v-if="subjects.result == 'passed'" style="text-decoration:none;color:white" class="btn-success btn-sm">Pass</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="textbox">
                    <h6>
                      Result:
                      <a v-if="StudentExam.Result == 'failed'" style="text-decoration:none;color:white" class="btn-danger btn-sm">Fail</a>
                      <a v-if="StudentExam.Result == 'passed'" style="text-decoration:none;color:white" class="btn-success btn-sm">Pass</a>
                    </h6>
                  </div>
                  <div class="textbox">
                    <h6>Grand Total:{{StudentExam.total_get_marks}}/{{StudentExam.total_full_marks}}</h6>
                  </div>
                  <div class="textbox">
                    <h6>Percentage :{{StudentExam.percentage}}%</h6>
                  </div>
                  <div class="textbox">
                    <h6 v-if="StudentExam.grade != ''">Grade: {{StudentExam.grade}} </h6>
                    <h6 v-else >Grade: No Assign </h6>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
          </div>
          <div class="card-body" v-if="document===true">
            <div style="float:right;" class="topbutton">
              <button class="search" data-toggle="modal" data-target="#exampleModalCenter" @click="clickUpload()">
                <i class="fa fa-upload"></i>Upload Document
              </button>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-striped" id="studenttable">
                <thead>
                  <tr>
                    <th>Titile</th>
                    <th class="all" nowrap>Name</th>
                    <th class="all" style="text-align: right;" nowrap>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="active" v-for="list in documents" :key="list.id">
                    <td class="all" nowrap>
                      <p class="toolText">{{list.document_title}}</p>
                    </td>
                    <td class="all" nowrap>
                      <p class="toolText">{{list.document_name}}</p>
                    </td>
                    <td style="text-align: right;" nowrap>
                      <i class="fa fa-download time"></i>
                      <i class="fa fa-times time"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-body TimeLine" v-if="timeline===true">
            <div>
              <span>09-09-2000</span>
              <div class="timeline">
                <div class="container right">
                  <div class="content" style="height:fit-content;">
                    <h6>Won Chess Championship Award</h6>
                    <p>Edward has won 1st Place in Inter school chess championship award.</p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <span>09-09-2000</span>
              <div class="timeline">
                <div class="container right">
                  <div class="content" style="height:fit-content;">
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
    <!-- <button type="button" @click="ExamList()">TEST</button> -->
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
export default {
  data() {
    return {
      documentData:{
        document_title:'',
      },
      profile: true,
      exam: false,
      document: false,
      timeline: false,
      class_id:'',
      sibling_class_id:'',
      sibling_section_id:'',
      section_id:'',
      student:[],
      sibling:[],
      documents:[],
      studentExam : []
    };
  },
  created(){
  EventBus.$emit("ThemeClicked");
    var id = this.$route.params.id;
    this.axios
    .get(`/api/student/edit/${id}`)
    .then(response=>{
      this.student = response.data[0];
      console.log(this.student);
      this.axios
      .get(`api/student/selectsection/${this.student.class_sections_id}`)
      .then(response1=>{
        this.class_id = response1.data.classes[0].class;
        this.section_id = response1.data.sections[0].section;
      })
      this.ExamList();
      this.axios
      .get(`api/uploaddocuments/show/${this.student.admission_no}`)
      .then(response2=>{
        this.documents = response2.data;
      })
      this.axios
      .get(`/api/studentsiblings/siblings/${this.student.admission_no}`)
      .then(response=>{
        if(response.data == null){
          this.sibling =[];
        }else{
        this.sibling = response.data[0];
        if(this.sibling){
          this.axios
        .get(`api/student/selectsection/${this.sibling.class_sections_id}`)
        .then(response3=>{
          this.sibling_class_id = response3.data.classes[0].class;
          this.sibling_section_id = response3.data.sections[0].section;
        })
        }
        
        }
        // console.log("sibling"+JSON.stringify(response.data));
      })
    })
    .catch(error=>{
    });
  },
  methods: {
    addDocument(){
      const config = {
        headers: { "content-type": "multipart/form-data" }
      };
      var fileOne ={};
      if(this.documentData.document_title || this.documentData.document_name){
        fileOne={
          'admission_no':this.student.admission_no,
          'document_title':this.documentData.document_title,
          'document_name':this.documentData.document_name,
          'is_active':this.student.is_active,
          'domain':this.student.domain,
          'file':this.documentData.file,
          'session_id':this.student.session_id,
        }
      }
      let dataDocument1 = new FormData();
      if(this.documentData.document_title || this.documentData.document_name){
        console.log("One");
        dataDocument1.append('admission_no',fileOne.admission_no);
        dataDocument1.append('document_title',fileOne.document_title);
        dataDocument1.append('document_name',fileOne.document_name);
        dataDocument1.append('is_active',fileOne.is_active);
        dataDocument1.append('domain',fileOne.domain);
        dataDocument1.append('file',fileOne.file);
        dataDocument1.append('session_id',fileOne.session_id);
        this.axios
          .post('api/uploaddocuments/add',dataDocument1,config)
          .then(response=>{
            this.axios
          .get(`api/uploaddocuments/show/${this.student.admission_no}`)
          .then(response2=>{
            this.documents = response2.data;
          })
          })
      }
      
    },
    clickUpload(){
      this.documentData = {};
      $('#section').val('');
    },
    onFileChange(e) {
        this.documentData.document_name = e.target.files[0].name;
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;
        reader.onload = (e) => {
        vm.documentData.file = file;
        }
      reader.readAsDataURL(file);
    },
    showData(name) {
      if (name == "profile") {
        EventBus.$emit("ThemeClicked");
        this.profile = true;
        this.exam = false;
        this.document = false;
        this.timeline = false;
      } else if (name == "exam") {
        EventBus.$emit("ThemeClicked");
        this.profile = false;
        this.exam = true;
        this.document = false;
        this.timeline = false;
      } else if (name == "document") {
        this.profile = false;
        this.exam = false;
        this.document = true;
        this.timeline = false;
      } else if (name == "timeline") {
        this.profile = false;
        this.exam = false;
        this.document = false;
        this.timeline = true;
      }
    },ExamList(){
      this.axios.get(`api/exams/getStudentExam/${this.student.admission_no}`)
      .then(response =>{
        var RETURNDATA = response.data;
        this.studentExam = response.data;
      })
      
    }
  }
};
</script>