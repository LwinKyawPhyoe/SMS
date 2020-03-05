<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Attendance</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Attendance By Date
      </h4>
    </div>
    <hr />
    <Loading></Loading>
    <div class="card">
      <div class="card-header">
        <h6>Select Attendance By Date</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
           <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="section" class="title">
              Class
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class" @change="selectClass($event)" v-model="class_id" id="class"
            @keyup="onValidate(class_id, 'class', 'class_msg')"
               v-on:blur="onValidate(class_id, 'class', 'class_msg')"
            >
              <option selected disabled>Select Class</option>
              <option v-for="list in classList" :key="list.id" :value="list.id">{{list.class}}</option>
            </select>
            <span id="class_msg" class="error_message">Class required.</span>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="section" class="title">
              Section
              <strong>*</strong>
            </label>
            <select class="inputbox" name="class" v-model="section_id" @change="selectSection($event)" id="section"
              @keyup="onValidate(section_id, 'section', 'section_msg')"
               v-on:blur="onValidate(section_id, 'section', 'section_msg')"
            >
              <option selected disabled>Select Section</option>
              <option v-for="list in sectionList" :key="list.id" :value="list.id">{{list.section}}</option>
            </select>
            <span id="section_msg" class="error_message">Section requred.</span>
          </div>
          <div class="col-lg-4 col-md-4 col-12 textbox">
            <label for="admDate">Attendance Date
              <strong>*</strong>
            </label>
            <!-- <VueCtkDateTimePicker
              v-model="attendance_date"
              :only-date="true"
              :color="'#1b5e20'"
              :button-color="'#1b5e20'"
              :auto-close="true"
              :format="'YYYY-MM-DD'"
              :formatted="'YYYY/MM/DD'"
              >
              <input
                  id="admDate"
                  class="inputbox"
                  autocomplete="off"
                  @keyup="onValidate(attendance_date, 'admDate', 'admDate_msg')"
                  v-on:blur="onValidate(attendance_date, 'admDate', 'admDate_msg')"
                />
                </VueCtkDateTimePicker> -->
                <datepicker v-model="attendance_date" id="admDate"
                  @keyup="onValidate(attendance_date, 'admDate', 'admDate_msg')"
                  v-on:blur="onValidate(attendance_date, 'admDate', 'admDate_msg')"
                ></datepicker>
                <span id="admDate_msg" class="error_message">Attendance date required.</span>
          </div>
          <div class="col-12 column-12">
            <button class="searchButton" id="globalSearch" @click="search()">Search</button>
          </div>
        </div>
      </div>

      <div v-if="view">
      <div class="sub-header">
        <h6>Attendance List</h6>
      </div>
      <div class="card-body">
        <div v-if="attendance.length ==0">
          <h1 class="NoData" style="margin-top:0px;">No Data</h1>
        </div>
        <div v-else>
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
              <a onclick="showColumns()" title="Columns">
                <i class="fa fa-columns"></i>
              </a>
              <div id="columns" class="columns">
                <p
                  onclick="showTableHeader('AdmNumber')"
                  style="border-radius: 5px 5px 0 0;"
                  id="AdmNumber"
                  class="tableLink"
                >
                  <span>Admission</span>
                </p>
                <p onclick="showTableHeader('RollNum')" id="RollNum" class="tableLink">
                  <span>RollNumber</span>
                </p>
                <p onclick="showTableHeader('Name')" id="Name" class="tableLink">
                  <span>Name</span>
                </p>
                <p onclick="showTableHeader('Attendance')" id="Attendance" class="tableLink">
                  <span>Attendance</span>
                </p>
                <p
                  class="tableLinks"
                  @click="allTableHeader('AdmNumber','RollNum','Name','Attendance')"
                  style="border-radius: 0 0 5px 5px;"
                >
                  <span>Restore visibility</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr role="row">
                <th class="all" nowrap>No</th>
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Roll Number</th>
                <th class="all" nowrap>Name</th>
                <th class="all" style="text-align:right;" nowrap>Attendance</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" v-for="(list,index) in attendance" :key="list.id">
                <td class="all" nowrap>{{index+1}}</td>
                <td class="all" nowrap>{{list.admission_no}}</td>
                <td class="all" nowrap>{{list.roll_no}}</td>
                <td class="all" nowrap>{{list.name}}</td>
                <td class="all" style="text-align:right;" nowrap>
                  <a v-if="list.attendance_type_id==1"
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-success btn-sm"
                  >Present</a>
                  <a v-if="list.attendance_type_id==2"
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-warning btn-sm"
                  >Late</a>
                  <a v-if="list.attendance_type_id==3"
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-danger btn-sm"
                  >Absent</a>
                  <a v-if="list.attendance_type_id==4"
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-primary btn-sm"
                  >Half</a>
                  <a v-if="list.attendance_type_id==5"
                    href="#"
                    style="text-decoration:none;margin-right:5px;"
                    class="btn-secondary btn-sm"
                  >Holiday</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
      </div>
    </div>
  </div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
import {Util} from '../../js/util';
import message from "../Alertmessage/message.vue";
import Loading from "../LoadingController.vue";
import datepicker from "../datepicker.vue";
export default {
  components: {
    VueCtkDateTimePicker,
    message,
    datepicker,
    Loading
  },
  data() {
    return {
      attendance_date: new Date().toISOString().slice(0, 10),
      classList:[],
      show: null,
      sectionList:[],
      section_id:'',
      class_id:'',
      class_section_id:'',
      attendance:[],
      viladition:false,
      view:false,
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
    search(){
      
      this.view = true;
      this.formViladition();
      if(this.viladition){
        EventBus.$emit("onLoad");
         var todaydate = this.date;
            this.axios
            .get(`/api/studentattendance/search/${this.class_section_id}/${this.attendance_date}`)
            .then(response=>{
              this.attendance = response.data.data;
              // console.log("search data",JSON.stringify(response.data));
             this.attendance_type_id = response.data.data[0].attendance_type_id;
             EventBus.$emit("onLoadEnd");
            
            })
            .catch(error=>{
              console.log(error.response)
            });
            this.view = true;
            EventBus.$emit("ThemeClicked");
      }
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
     formViladition(){
      this.viladition = true;
      if(!this.class_id){
        this.onValidationMessage("class", "class_msg");
        this.viladition = false;
      }
      if(!this.section_id){
        this.onValidationMessage("section", "section_msg");
        this.viladition = false;
      }
      if(!this.attendance_date){
        this.onValidationMessage("admDate", "admDate_msg");
        this.viladition = false;
      }
    },
     allData(){
      this.axios
        .get('/api/student')
        .then(response=>{
          this.classList = response.data.class;
          EventBus.$emit("onLoadEnd");
        });
      },
       selectClass(e){
            this.sectionList =[];
            this.section_id ='';
            var id = e.target.value;
            this.axios
              .get(`/api/student/section/${id}`)
              .then(response=>{
                this.sectionList = response.data;
              })
           },
           selectSection(e){
              var id_section = e.target.value;
              var id_class = this.class_id;
              var array =[];
              this.axios
              .get(`/api/student/class_section/${id_class}/${id_section}`)
              .then(response=>{
                array = response.data;
                this.class_section_id = array[0].id;
                console.log(this.class_section_id);
              })
            },
         
    allTableHeader(id, id1, id2, id3) {
      document.getElementById(id).style.background = "#1b5e20";
      document.getElementById(id).style.color = "white";
      document.getElementById(id1).style.background = "#1b5e20";
      document.getElementById(id1).style.color = "white";
      document.getElementById(id2).style.background = "#1b5e20";
      document.getElementById(id2).style.color = "white";
      document.getElementById(id3).style.background = "#1b5e20";
      document.getElementById(id3).style.color = "white";
    }
  }
};
</script>