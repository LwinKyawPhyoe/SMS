<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Attendance</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link> > Student Attendance
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
            <VueCtkDateTimePicker
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
                </VueCtkDateTimePicker>
                <span id="admDate_msg" class="error_message">Attendance date required.</span>
          </div>
          <div class="col-12">
            <button class="searchButton" @click="search()">Search</button>
          </div>
        </div>
      </div>
      <div v-if="view">

      <div class="sub-header">
        <h6>Student List</h6>
      </div>
      <div class="card-body" >
        <div v-if="attendance.length ==0">
          <h1 class="NoData" style="margin-top:0px;">No Data</h1>
        </div>
      <div v-else>
        <label class="btn btn-dark">
          <input type="checkbox" style="margin-right:5px;" id="holiday" @click="checkHoliday($event)" v-if="attendance.length !=0" :checked="attendance_type_id == 5"/> Mark as holiday
        </label>
        <button type="submit" @click="Save()" style="outline:none;float:right;" class="btn btn-dark" v-if="attendance.length !=0">Save Attendance</button>
        <div class="row" id="row" style="width:100%;">
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studenttable">
              <thead>
                <tr>
                  <th class="all" nowrap>No</th>
                  <th class="all" nowrap>Admission Number</th>
                  <th class="all" nowrap>Name</th>
                  <th class="all" nowrap colspan="4">Attendance</th>
                  <th class="all" nowrap>Note</th>
                </tr>
              </thead>
              <tbody>
                
                <tr class="active" v-for=" (n,index) in attendance" :key="n.id">
                  <td class="all" nowrap>{{index+1}}</td>
                  <td class="all" nowrap>{{n.admission_no}}</td>
                  <td class="all" nowrap>{{n.name}}</td>
                  <td class="all" nowrap v-for="type in attendance_type" :key="type.id" id="attendancetype">
                    <input
                      style="cursor: pointer;"
                      type="radio"
                      :id="n.admission_no + type.type"
                      :name="n.admission_no + type.id"
                      :value="type.id"
                      v-model="n.attendance_type_id"
                      :disabled ="n.attendance_type_id == 5"
                    />
                    <label :for="n.admission_no + type.type">
                      {{
                      type.type
                      }}
                    </label>
                  </td>
                  <td>
                    <input type="text" class="note" v-model="n.remark"/>
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
  </div>
</template>
<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
export default {

  components: {
    VueCtkDateTimePicker
  },
  data() {
            return {
              view:false,
              attendance:[],
              attendance_date: new Date().toISOString().slice(0, 10),
              date:'',
              class_id:'',
              classList:[],
              section_id:'',
              sectionList:[],
              class_section_id:'',
              attendance_type: [],
              student:[],
              isholiday:false,
              attendance_type_id:'',
              message:[],
              updatedata:[],
              viladition:true,
            }
        },
        created() {
            this.allData();
            this.axios
                .get('/api/attendancetypes')
                .then(response => {
                    this.attendance_type = response.data;
                    console.log(JSON.stringify(response.data));
                    for(let i =0; i <this.student.length; i++){
                      this.student[i].attendance = this.attendance_type[this.attendance_type.length-1].id;
                    }
                });

        },
        methods:{
          
          checkHoliday(env){
            if(env.target.checked){
              this.attendance_type_id="5";
              for(let i =0;i<this.attendance.length;i++){
                this.attendance[i].attendance_type_id = "5";
              }
              // $("#attendancetype").attr('disabled','disabled');
              // $("#attendancetype").prop('disabled',true);
              $("#attendancetype *").prop('disabled',true);
            }else{
              this.attendance_type_id="";
              for(let i =0;i<this.attendance.length;i++){
                this.attendance[i].attendance_type_id = "1";
              }
              $("#attendancetype *").prop('disabled',false);
            }
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
         
      allData(){
      this.axios
        .get('/api/student')
        .then(response=>{
          this.classList = response.data.class;
        });
      },
        
          Save(){
            console.log(JSON.stringify(this.attendance))
            for(let i =0;i<this.attendance.length;i++){
              this.axios
              .post(`/api/studentattendance/add`,this.attendance[i])
              .then(response=>{
                this.message.text = response.data.text;
                this.message.type = response.data.type;
              })
            }
            this.attendance=[];
            this.class_id ='';
            this.section_id ='';
            this.attendance_date = new Date().toISOString().slice(0, 10);
            this.view = false;
          },
          search(){
            this.formViladition();
            if(this.viladition){
              var todaydate = this.date;
            this.axios
            .get(`/api/studentattendance/show/${this.class_section_id}/${this.attendance_date}`)
            .then(response=>{
              this.attendance = response.data.data;
              console.log("search data",JSON.stringify(response.data));
              this.view = true;
             this.attendance_type_id = response.data.data[0].attendance_type_id;
             this.updatedata.text = response.data.text;
             this.updatedata.type = response.data.type;
            })
            .catch(error=>{
              console.log(error.response)
            });
            
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

        }
}
</script>