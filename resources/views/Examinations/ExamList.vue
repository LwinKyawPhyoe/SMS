<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Exam List
      </h4>
    </div>
    <hr />
    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Exam</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <div id="OthAlert" style="margin: 0 10px 10px 10px;display:none;" class="alert alert-success" role="alert">
                {{ successAlertmsg }}
                <button @click="goAlertClose(1)" type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-12">
              <label for="name">Name<strong>*</strong></label>
              <input id="nameid" type="text" class="inputbox" name="name" v-model="saveexam.name"
              @keyup="onValidate(saveexam.name, 'nameid', 'namemsg')" 
                v-on:blur="onValidate(saveexam.name, 'nameid', 'namemsg')"/>
                 <span id="namemsg" class="error_message">Name is required</span>
            </div>
            <div class="col-12">
              <label for="note">Note</label><br>
              <textarea class="textareas" rows="3" v-model="saveexam.remark"></textarea>
            </div><br>

            <label v-if="savebutton == true" style="margin-left:50px;">Please Activate Academic Year <strong>*</strong></label>
            <div class="col-12">
              <button class="save" @click="addExam(SessionList.id)" v-for="SessionList in SessionList" :key="SessionList.id">Save</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7 col-md-12" style="padding-left:0;">
        <div class="card">
          <div class="card-header">
            <h6>Exam List</h6>
          </div>
          <div class="card-body">
            <div id="deleteAlert" style="margin: 10px 10px 10px 10px;display:none;" class="alert alert-success" role="alert">
                {{successAlertmsg1}}
                <button @click="goAlertClose(2)" type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input v-on:keyup="searchTable()" type="text" placeholder="Search..." class="searchText" id="myInput" />
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
                  <a onclick="showColumns()" title="Columns">
                    <i class="fa fa-columns"></i>
                  </a>
                  <div id="columns" class="columns">
                    <p onclick="showTableHeader('Name')" id="Name" class="tableLink">
                      <span>Name</span>
                    </p>
                    <p onclick="showTableHeader('Action')" id="Action" class="tableLink">
                      <span>Action</span>
                    </p>
                    <p
                      class="tableLinks"
                      @click="allTableHeader('Name','Action')"
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
                  <tr>
                    <th class="all" nowrap>Name</th>
                    <th class="all" style="text-align: right;" nowrap>Action</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <tr class="active" v-for="exams in exams" :key="exams.id">
                    <td class="all" nowrap v-if="exams.is_active != 'delete'">
                      <p class="toolText">
                        {{ exams.name }}
                        <span class="tooltipLabel" v-if="exams.remark != 'delete'">{{ exams.remark }}</span>
                        <span class="tooltipLabel" v-if="exams.remark == null">No Description</span>
                      </p>
                    </td>
                    <td style="text-align: right;" v-if="exams.is_active != 'delete'">
                      <i class="fa fa-pencil pen" @click="goEdit(exams.id)">
                        <span class="penLabel">Edit</span>
                      </i>
                      <i class="fa fa-trash time" @click="goDelete(exams.id)">
                        <span class="timeLabel">Delete</span>
                      </i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <button type="button" @click="Test()">Test</button> -->
  </div>
</template>
<script>
    export default {
        data() {
            return {
                exams: [],
                SessionList: [],
                 saveexam: {},
                errors: [],
                successAlertmsg: "",
                successAlertmsg1: "",
                erroralertmsg: "",
                savebutton:''
            }
        },
        created() {
            this.getdata();
            this.getAcademic();
        },
        methods: {
            getdata(){
              this.axios
                .get('/api/ExamList')
                .then(response => {
                    this.exams = response.data;
                    // console.log(response.data);
                });
            },getAcademic(){
               this.axios
                .get('/api/activeacademicyr') 
                .then(response => {
                this.SessionList = response.data;
                var academicYr = response.data;
                if (academicYr.length ==1 ){
                  this.savebutton = false;
                }else{
                  this.savebutton = true;
                }
                });
            },Test(para){
              console.log(para);
            },
            addExam(session_id) {
              if(this.checkValidate())
              {
                if(this.saveexam.remark==null){
                this.saveexam.remark='No Description'
                }
                this.saveexam.session_id=session_id;
                this.saveexam.domain = 'TS',
                this.axios
                .post('/api/exams/addexam', this.saveexam)
                .then(response => (   
                
                // this.saveexam = {"id":"","name":"","session_id":"","remark":"","created_at":"","updated_at":""},
                this.saveexam.name=null,
                this.saveexam.remark=null,
                this.getdata(),
                console.log(JSON.stringify(response)),
                this.successAlertmsg = response.data,
                $('#OthAlert').css('display', 'block')
                ))
              .catch(error => {            
                console.log("err->" + JSON.stringify(error));         
              });
                  }
                  },
                  goAlertClose(aVal){
                  if(aVal == 1) $('#OthAlert').css('display', 'none')
                  else $('#deleteAlert').css('display', 'none')
                  },
                  goEdit(id){      
                  this.axios
                    .get(`/api/exams/editexam/${id}`)
                    .then(response => {
                        this.saveexam = response.data;
                    });
                },
                goDelete(id){
                this.axios
                .get(`/api/exams/deleteexam/${id}`)
                .then(response => {
                let i = this.exams.map(item => item.id).indexOf(id);
                this.exams.splice(i, 1);
                this.successAlertmsg1 = response.data,
                $('#deleteAlert').css('display', 'block')
                });
                },
                searchTable(){      
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
    },onValidate(value, inputId, megId)
    {
        if(value == "" || value == undefined) document.getElementById(inputId).style.border = 'solid 1px red';
        else 
        {
            document.getElementById(inputId).style.border = 'solid 1px #d2d6de';
            document.getElementById(megId).style.display = 'none';
        }
    },

    onValidateMessage(inputId, megId)
    {
        document.getElementById(inputId).style.border = 'solid 1px red';
        document.getElementById(megId).style.display = 'block';
    },

    checkValidate()
    {
        if(this.saveexam.name == "" || this.saveexam.name == undefined)
        {
            this.onValidateMessage('nameid', 'namemsg');
            return false;
        }
        else
        {
            return true;
        }
        return false;
    },Test(){
      this.axios.get(`/api/ExamList`).then(response=>{
        console.log(response.data);
      })
    }
  }
  }
    
</script>