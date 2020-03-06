<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Examinations</h2>
      <h4 class="stuLink">
        <router-link to="/dashboard" class="home">Home</router-link>> Exam List
      </h4>
    </div>
    <hr />
    <confirm :url="props"></confirm>
    <Loading></Loading>
    <div class="row rowContainer" style="align-items: end !important;">
      <div class="col-lg-5 col-md-12" style="padding-left:2px;">
        <div class="card">
          <div class="card-header">
            <h6>Add Exam</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" id="alertmsg" />
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
            <div class="col-12 column-12">
              <button class="save" id="globalSave" @click="addExam()">Save</button>
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
            <message :alertmessage="deletemsg" id="delalertmsg" />
            <input v-on:keyup="searchTable()" type="text" placeholder="Search..." class="searchText" id="myInput" />
            <div class="copyRows">
              <div class="row" id="copyRow">
                <div class="col-3">
                  <a href="#" title="Excel" @click.prevent="downloadExcel('studenttable', 'name', 'ExamLists.xls')">
                    <i class="fa fa-file-excel-o"></i>
                  </a>
                </div>
                <div class="col-3">
                  <a href="#" title="Print" @click.prevent="printme('print')">
                    <i class="fa fa-print"></i>
                  </a>
                </div>
                <div class="col-3">
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
            <div v-if="data == false">
              <h1 class="NoData">No Data</h1>
            </div>
            <div class="table-responsive" v-else id="print">
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
                      <i  data-toggle="modal"
                        data-target="#exampleModalCenter" class="fa fa-trash time" @click="goDelete(exams.id)">
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
import { EventBus } from "../../js/event-bus.js";
import Loading from "../LoadingController.vue";
import confirm from "../message/confirm.vue";
import message from '../Alertmessage/message.vue';
import { Util } from "../../js/util";
    export default {
      components: {
          Loading,
          confirm,
          message
        },
        data() {
            return {
              props: {
                    url: "",
                    type: ""
                },
                msg: {
                text: "",
                type: ""
                },
                deletemsg: {
                text: "",
                type: ""        
                }, 
                exams: [],
                SessionList: [],
                 saveexam: {},
                errors: [],
                successAlertmsg: "",
                successAlertmsg1: "",
                erroralertmsg: "",
                savebutton:'',
                data : false
            }
        },
        mounted(){
          EventBus.$emit("onLoad");
          this.getdata();
        },
        created() {
            
            EventBus.$emit("ThemeClicked");
            EventBus.$on("clicked", response => {
            this.getdata();
            this.deletemsg.text = 'Deleted Successfully',
            this.deletemsg.type = 'success'
            Util.workAlert("#delalertmsg");
            });
        },
        methods: {
            getdata(){
              this.axios
                .get('/api/ExamList')
                .then(response => {
                    this.exams = response.data;
                    if(this.exams.length > 0){
                      this.data = true;
                    }else{
                      this.data = false;
                    }
                    EventBus.$emit("onLoadEnd");
                });
            },
            addExam() {
              if(this.checkValidate())
              {
                EventBus.$emit("onLoad");
                // EventBus.$emit("clicked");
                if(this.saveexam.remark==null){
                this.saveexam.remark='No Description'
                }
                this.saveexam.domain = 'TS',
                this.axios
                .post('/api/exams/addexam', this.saveexam)
                .then(response => (   
                
                this.saveexam = {"id":"","name":"","session_id":"","remark":"","is_active":'',"domain":'', "created_at":"","updated_at":""},
                this.getdata(),
                this.msg.text = response.data,
                this.msg.type = 'success',
                Util.workAlert("#alertmsg"),
                EventBus.$emit("onLoadEnd")
                ))
              .catch(error => {            
                console.log("err->" + JSON.stringify(error));         
              });
                  }
                  },
                  goEdit(id){      
                  this.axios
                    .get(`/api/exams/editexam/${id}`)
                    .then(response => {
                        this.saveexam = response.data;
                    });
                },
                goDelete(id){
                  var funName = "deleteexam";
                  this.props.type = "theinDelete";
                  this.props.url = `exams/${funName}/${id}`;
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
    },
    printme(table) {
      Util.printme(table);
    },
    downloadExcel(table, name, filename) {
      Util.downloadExcel(table, name, filename);
    }
  }
  }
    
</script>