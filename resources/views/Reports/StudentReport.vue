<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Reports</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Student Report
      </h4>
    </div>
    <hr />

    <div class="card">
      <div class="card-header">
        <h6>Select Reports</h6>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-4 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Class
            </label>
            <select class="inputbox" name="class" v-model="class_id"
            @change="selectClass($event)"
            >
              <option selected disabled>Select Class</option>
              <option v-for="list in classList" :key="list.id"  :value="list.id">{{list.class}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Section
            </label>
            <select class="inputbox" v-model="section_id">
              <option selected disabled>Select Section</option>
              <option v-for="list in sectionList" :key="list.id"  :value="list.id">{{list.section}}</option>
            </select>
          </div>
          <div class="col-lg-4 col-md-6 col-12  textbox">
            <label for="name" class="title">
              Gender
            </label>
            <select class="inputbox" name="class" v-model="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-lg-12 col-md-3 col-12 textbox">
            <button class="searchButton" style="margin-top: 1.8rem !important;" @click="searchReport()">Search</button>
          </div>
        </div>
      </div>
      <div v-if="search">
      <div class="sub-header">
        <h6>Student Report</h6>
      </div>
      <div class="card-body">
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
              <a title="Columns">
                <i class="fa fa-columns"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table
            class="table table-hover table-striped"
            id="studenttable"
          >
            <thead>
              <tr style="font-size:14px;">
                <th class="all" nowrap>Admission Number</th>
                <th class="all" nowrap>Student Name</th>
                <th class="all" nowrap>Class</th>
                <th class="all" nowrap>Section</th>
                <th class="all" nowrap>Father Name</th>
                <th class="all" nowrap>Mother Name</th>
                <th class="all" nowrap>Date Of Birth</th>
                <th class="all" nowrap>Gedner</th>
                <th class="all" nowrap>Mobile Number</th>
                <th class="all" nowrap>Guardian Name</th>
                <th class="all" nowrap>Guardian phone</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" style="border-bottom: 1px solid #ebebeb;" v-for="list in studentList" :key="list.id">
                <td class="all" nowrap>{{list.admission_no}}</td>
                <td class="all" nowrap>{{list.name}}</td>
                <td class="all" nowrap>{{list.class}}</td>
                <td class="all" nowrap>{{list.section}}</td>
                <td class="all" nowrap>{{list.father_name}}</td>
                <td class="all" nowrap>{{list.mother_name}}</td>
                <td class="all" nowrap>{{list.dob}}</td>
                <td class="all" nowrap>{{list.gender}}</td>
                <td class="all" nowrap>{{list.mobileno}}</td>
                <td class="all" nowrap>{{list.guardian_name}}</td>
                <td class="all" nowrap>{{list.guardian_phone}}</td>
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
export default {
  data() {
    return {
      viladition:true,
      search:false,
      classList:[],
      sectionList:[],
      section_id:'',
      class_id:'',
      gender:'',
      class_section_id:'',
      keyword:'',
      studentList:[
      ],
      check:false,
    };
  },
  created(){
    EventBus.$emit("ThemeClicked");
    this.allData();
  },
 
 
  methods: {
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
          console.log(JSON.stringify(this.classList));
        });
    },
    searchReport(){
      this.search = true;
      if(this.class_id && this.section_id && this.gender){
        this.axios
      .get(`/api/student/studentReport/${this.class_id}/${this.section_id}/${this.gender}`)
      .then(response=>{
        this.studentList = response.data;
      })
      }else if(this.class_id && this.section_id){
        this.axios
        .get(`/api/student/studentReport1/${this.class_id}/${this.section_id}`)
        .then(response=>{
          this.studentList = response.data;
        })
      }else if(this.class_id && this.gender){
        this.axios
        .get(`/api/student/studentReport2/${this.class_id}/${this.gender}`)
        .then(response=>{
          this.studentList = response.data;
        })
      }else if(this.class_id){
        this.axios
        .get(`/api/student/studentReport3/${this.class_id}`)
        .then(response=>{
          this.studentList = response.data;
        })
      }else if(this.gender){
        this.axios
        .get(`/api/student/studentReport4/${this.gender}`)
        .then(response=>{
          this.studentList = response.data;
        })
      }else{
        this.axios
        .get(`/api/student/show`)
        .then(response=>{
          this.studentList = response.data;
        })
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
  }
};
</script>