<template>
  <div class="StudentHistory form" id="bar">
    <div class="toplink">
      <h4 style="color:var(--primary);margin-bottom:5px;">Students</h4>
      <h6>
        <router-link to="/Student" class="home">Home</router-link>> Student History
      </h6>
    </div>
    <hr />
    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
      </div>
      <div class="stucard-body">
        <div class="row">
          <div class="textarea">
            <label for="class">Class
              <strong>*</strong>
            </label>
            <select id="class" class="inputbox"
            @keyup="onValidate(class_id, 'class', 'class_msg')"
            v-on:blur="onValidate(class_id, 'class', 'class_msg')"
            @change="selectClass($event)"
            v-model="class_id">
              <option selected disabled>Select Class</option>
              <option v-for="list in classList" :key="list.id" :value="list.id">
                {{list.class}}
              </option>
              
            </select>
            <span id="class_msg" class="error_message">Class reqiruired.</span>
          </div>
          <div class="textarea">
            <label for="section">Seciton
               <strong>*</strong>
            </label>
            <select id="section" class="inputbox" 
            @keyup="onValidate(section_id, 'section', 'section_msg')"
            v-on:blur="onValidate(section_id, 'section', 'section_msg')"
            @change="selectSection($event)"
            v-model="section_id">
              <option disabled selected>Select section</option>
              <option v-for="list in sectionList" :key="list.id" :value="list.id">{{list.section}}</option>
            </select>
            <span id="section_msg" class="error_message">Section required.</span>
            <button class="searchButton" id="globalSearch" @click="searchBySectionId()">Search</button>
          </div>
        </div>
      </div>
      <div v-if="search">
      <div class="sub-header">
        <h6>Student History</h6>
      </div>
      <div class="stucard-body">
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
          <table class="table table-hover table-striped">
            <thead>
              <tr class="active">
               
                <th nowrap>Admission Number</th>
                <th nowrap>Student Name</th>
                <th nowrap>Admission Date</th>
                <th nowrap>Session(Start-End)</th>
                <th nowrap>Years</th>
                <th nowrap>Mobile Number</th>
                <th nowrap>Guardian Name</th>
                <th nowarp>Guardian Phone</th>
                <th nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" v-for="list in studentList" :key="list.id">
                <td nowrap>{{list.admission_no}}</td>
                <td nowrap>{{list.name}}</td>
                <td nowrap>{{list.admission_date}}</td>
                <td nowrap>{{list.session_start}}-{{list.session_end}}</td>
                <td nowrap>{{list.year}}</td>
                <td nowrap>{{list.mobileno}}</td>
                <td nowrap>{{list.guardian_name}}</td>
                <td nowrap>{{list.guardian_phone}}</td>
                
                <td>
                  <router-link onclick="showForm()" to="/viewstudent">
                    <i class="fa fa-list"></i>
                  </router-link>
                  
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
export default {
  data() {
    return {
      viladition:true,
      search:false,
      classList:[],
      sectionList:[],
      section_id:'',
      class_id:'',
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
        });
    },
    searchBySectionId(){
      this.formViladition();
      if(this.viladition == true){
        this.axios
      .get(`/api/student/sibling/${this.class_section_id}`)
      .then(response=>{
        this.search = true;
        var student = response.data;
        
        var studentArray =[];
        
        if(student.length == 0){
          this.check = false;
        }else{
          this.check = true;
        }
        
        console.log("student array"+JSON.stringify(studentArray));
        for(let i=0;i<student.length;i++){
          this.axios
        .get(`/api/student/selectsection/${student[i].class_sections_id}`)
        .then(response1=>{
          var classes = response1.data.classes[0].class +'('+ response1.data.sections[0].section +')';
          studentArray.push(
            {
              'id':student[i].id,
              'admission_no':student[i].admission_no,
              'image':student[i].image,
              'name':student[i].name,
              'father_name':student[i].father_name,
              'mother_name':student[i].mother_name,
              'guardian_name':student[i].guardian_name,
              'dob':student[i].dob,
              'gender':student[i].gender,
              'class':classes,
              'mobileno':student[i].mobileno,
              'guardian_phone':student[i].guardian_phone,
              'current_address':student[i].current_address,
              'admission_date':student[i].admission_date,
              'session_start':student[i].session_start,
              'session_end':student[i].session_end,
              // 'years':
            }
          )          
        })
        this.studentList = studentArray;
        }
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
    },
  }
};
</script>