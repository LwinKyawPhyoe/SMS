<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Download Center</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Syllabus
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;"/>
    <Loading></Loading>
    <confirm :url="props"></confirm>

    <div class="card">
      <div class="card-header">
        <h6>Syllabus List</h6>
      </div>
      <div class="card-body">
        <message :alertmessage="msg" id="alertmsg"/>
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">                
            <div class="col-3">
              <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Upload_Content.xls')" title="Excel">
                <i class="fa fa-file-excel-o"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" @click.prevent="printme('print')" title="Print">
                <i class="fa fa-print"></i>
              </a>
            </div>
            <div class="col-3">
              <a title="Columns" @click="showColumns()">
                <i class="fa fa-columns"></i>
              </a>
              <div id="columns" class="columns">
                <div v-for="item in arrayTableColumns">
                    <p @click="showTableHeader(item)" :id="item.Id" class="tableLink">
                        <span>{{item.Name}}</span>
                    </p> 
                </div>
                <div>
                    <p @click="clickShowAllColumn(arrayTableColumns)" class="tableLinkActive">
                        <span>Restore visibility</span>
                    </p>
                </div>
              </div>
              <div @click="clickBackground()" id="backgroundColumn" class="column_background"></div>
            </div>
          </div>
        </div>
        <h1 class="NoData" v-if="ContentList.length==0">No Data</h1>
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="studenttable" v-if="ContentList.length!=0">
            <thead>
              <tr>
                <th :class="arrayTableColumns[0].class" nowrap>Content Title</th>
                <th :class="arrayTableColumns[1].class" nowrap>Type</th>
                <th :class="arrayTableColumns[2].class" nowrap>Date</th>
                <th :class="arrayTableColumns[3].class" nowrap>Available For</th>
                <th :class="arrayTableColumns[4].class" nowrap>Class</th>
                <th :class="arrayTableColumns[5].class" style="text-align:right;" nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" v-for="item in ContentList">
                <td :class="arrayTableColumns[0].class" nowrap>
                  <p class="toolText">
                    {{item.title}}
                    <span class="tooltipLabel">No Description</span>
                  </p>
                </td>
                <td :class="arrayTableColumns[1].class" nowrap>{{item.type}}</td>
                <td :class="arrayTableColumns[2].class" nowrap>{{showDate(item.date)}}</td>
                <td :class="arrayTableColumns[3].class" nowrap>
                  <p style="padding: 0;margin: 0;"
                  v-if="item.available_for == '1' || item.available_for == '1,2' || item.available_for == '2,1'">Super Admin</p>
                  <p style="padding: 0;margin: 0;"
                  v-if="item.available_for == '2' || item.available_for == '1,2' || item.available_for == '2,1'">Student</p>
                </td>
                <td :class="arrayTableColumns[4].class" nowrap>{{ReturnClass(item.class_section_id)}}</td>
                <td :class="arrayTableColumns[5].class" nowrap style="text-align:right;">
                  <i class="fa fa-download download" @click.prevent="downloadFile('Tran_Route.xls')">
                    <span class="downloadLabel">Download</span>
                  </i>
                  <i class="fa fa-trash time" @click="goDelete(item.id)" data-toggle="modal" data-target="#exampleModalCenter">
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
</template>
<script>

import message from "../Alertmessage/message.vue";
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js";
import {Util} from '../../js/util';
import Loading from "../LoadingController.vue";

export default 
{
  components: 
  {
    message,
    confirm,
    Loading,
  },
  data(){
    return {
      arrayTableColumns: [
        {"Name": "Content Title","Id": "Content_Id", "class": "tbl_body_Content"},
        {"Name": "Type","Id": "Type_Id", "class": "tbl_body_Type"},
        {"Name": "Date","Id": "Date_Id", "class": "tbl_body_Date"},
        {"Name": "Available For","Id": "Available_Id", "class": "tbl_body_Available"},
        {"Name": "Class","Id": "Class_Id", "class": "tbl_body_Class"},
        {"Name": "Action","Id": "Action_Id", "class": "tbl_body_Action"}
      ],
      props: {
        url: "",
        type: ""
      },
      msg: {
        text: "",
        type: ""
      },
      ContentList: [],
      ClassSessionList: [],
    }
  },
  mounted() {
    EventBus.$emit("onLoad");
  },
  created() 
  {
    EventBus.$emit("ThemeClicked");
    EventBus.$on("clicked", response => {
      this.getContent();
      this.msg.text = response.text;
      this.msg.type = response.type;
      Util.workAlert('#alertmsg');
    });
    this.getAllClass();
    this.getContent();
  },
  methods: {
    // Get Content
    getContent(){
      EventBus.$emit("onLoad");
      this.ContentList = [];
      this.axios.post('/api/content/show',{'type':'Syllabus'}).then(response => {
        this.ContentList = response.data;
        EventBus.$emit("onLoadEnd");
      });
    },
    // Get Class And 
    getAllClass(){
      this.axios.get('/api/class').then(response => {
        this.ClassSessionList = response.data;
      });
    },
    // Return Class Name
    ReturnClass(val){
      var name = "";
      if(val != null){
        name = "ALL Classes"
      }
      for(let i = 0;i < this.ClassSessionList.length;i++){
        if(this.ClassSessionList[i].class_section_id == val){
          name = this.ClassSessionList[i].class;
        }
      }
      return name;
    },
    //Delete Conteent
    goDelete(aID){
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `content/${funName}/${aID}`;
    },
    // Column Hide 
    showColumns(){
      Util.showColumns('columns','backgroundColumn');
    },
    clickBackground(){
      Util.clickBackground('columns','backgroundColumn');
    },
    showTableHeader(data){
      Util.showTableHeader(data);
    },
    clickShowAllColumn(data){
      Util.clickShowAllColumn(data);
    },
    showDate(date) {
      if(date){
        let day = date.substring(6, 8);
        let month = date.substring(4, 6);
        let year = date.substring(0, 4);
        return day + "/" + month + "/" + year;
      }
    },
  }
}
</script>