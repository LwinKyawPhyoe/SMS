<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Download Center</h2>
      <h4 class="stuLink">
        <router-link to="/home" class="home">Home</router-link>> Other Download
      </h4>
    </div>
    <hr />

    <confirm :url="props"></confirm>

    <div class="card">
      <div class="card-header">
        <h6>Other Download List</h6>
      </div>
      <div class="card-body">
      <message :alertmessage="deletemsg" />
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
              <a href="#" title="Columns">
                <i class="fa fa-columns"></i>
              </a>
            </div>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="studenttable">
            <thead>
              <tr>
                <th class="all" nowrap>Content Title</th>
                <th class="all" nowrap>Type</th>
                <th class="all" nowrap>Date</th>
                <th class="all" nowrap>Available For</th>
                <th class="all" nowrap>Class</th>
                <th class="all" style="text-align:right;" nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="active" v-for="item in ContentList">
                <td class="all" nowrap>
                  <p class="toolText">
                    {{item.title}}
                    <span class="tooltipLabel">No Description</span>
                  </p>
                </td>
                <td class="all" nowrap>{{item.type}}</td>
                <td class="all" nowrap>{{item.date}}</td>
                <td class="all" nowrap>
                <p style="padding: 0;margin: 0;"
                v-if="item.available_for == '1' || item.available_for == '1,2' || item.available_for == '2,1'">Super Admin</p>
                <p style="padding: 0;margin: 0;"
                v-if="item.available_for == '2' || item.available_for == '1,2' || item.available_for == '2,1'">Student</p>
                </td>
                <td class="all" nowrap>{{ReturnClass(item.class_section_id)}}</td>
                <td class="all" nowrap style="text-align:right;">
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

export default 
{
  components: 
  {
    message,
    confirm,
  },
  data(){
    return {
      props: {
        url: "",
        type: ""
      },
      deletemsg: {
        text: "",
        type: ""
      },
      ContentList: [],
      ClassSessionList: [],
    }
  },
  created() 
  {
    EventBus.$on("clicked", response => {
      this.getContent();
      this.deletemsg.text = response.text;
      this.deletemsg.type = response.type;
    });
    this.getAllClass();
    this.getContent();
  },
  methods: {
    // Get Content
      getContent(){
      this.ContentList = [];
      this.axios.post('/api/content/show',{'type':'Other Download'}).then(response => {
        this.ContentList = response.data;
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
        if(this.ClassSessionList[i].class_session_id == val){
          name = this.ClassSessionList[i].class;
        }
      }
      return name;
    },
    //Delete Conteent
    goDelete(aID){
      var funName = "delete"; /**Delete function */
      this.props.type = "get";
      this.props.url = `content/${funName}/${aID}`;
    },
  }
}
</script>