<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Upload Content</h2>
      <h4 class="stuLink">
        <router-link to="home" class="home">Home</router-link>> Upload Content
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;"/>

    <confirm :url="props"></confirm>
    <Loading></Loading>

    <div class="row" style="align-items: end !important;margin: 0px;">
      <div class="col-lg-4 col-md-12" style="padding:0px;">
        <div class="card">
          <div class="card-header">
            <h6>Upload Content</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" id="alertmsg"/>
            <form @submit.prevent="goSave">
              <div class="col-12">
                <label for="contentTitle">Content Title <strong>*</strong></label>
                <input type="text" id="content" class="inputbox" v-model="uploadContent.title"
                    @keyup="onValidate(uploadContent.title, 'content', 'title_msg')" 
                    v-on:blur="onValidate(uploadContent.title, 'content', 'title_msg')" />
                <span id="title_msg" class="error_message">Content title is required</span>
              </div>
              <div class="col-12">
                <label for="typeSection">Content Type <strong>*</strong></label>
                <select id="type" class="inputbox" v-model="uploadContent.type"
                  @change="onValidate(uploadContent.type, 'type', 'type_msg')" >
                  <option disabled value="">Select</option>
                    <option v-for="code in typeList" :key="code.value" :value="code.value">{{code.caption}}</option>
                </select>
                <span id="type_msg" class="error_message">Content type is required</span>
              </div>
              <div class="col-12">
                <label for="contentTitle">Available For <strong>*</strong></label>
                <div class="checkbox">
                  <label class="checkboxlabel">
                    <input type="checkbox" class="checkboxinput" v-model="checkAdmin"
                       @click="click_checkbox($event,1)"/>All Super Admin
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkboxlabel">
                    <input type="checkbox" class="checkboxinput" @change="CheckboxStudent(checkStudent)" 
                      v-model="checkStudent" @click="click_checkbox($event,2)"/>Student
                  </label>
                </div>
                <span id="available_msg" class="error_message">The Available for field is required</span>
              </div>
              <div id="classCol" style="background-color: #eae6e6;margin: 5px 0px;padding: 10px 0px">
                <div class="col-12">
                  <div class="checkbox">
                    <label class="checkboxlabel">
                      <input type="checkbox" class="checkboxinput" @change="CheckboxAvailable(checkAvailable)"
                        :disabled="AvailableDisabled" v-model="checkAvailable"/>Available For All Classes
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <label for="class_id">Class</label>
                  <select :disabled="classDisabled" id="class_id"  @change="selectClass()" class="inputbox" v-model="uploadContent.class">
                    <option disabled value="">Select Class</option>
                    <option v-for="item in ClassList" :value="item.id">{{item.class}}</option>
                  </select>
                  <span id="class_msg" class="error_message">The Available for field is required</span>
                </div>
                <div class="col-12">
                  <label for="section_id">Section</label>
                  <select :disabled="sectionDisabled" id="section_id" class="inputbox" v-model="uploadContent.section" @change="onValidate(uploadContent.section, 'section_id', 'section_msg')">
                    <option disabled value="">Select Section</option>
                    <option v-for="item in SectionList" :value="item.id">{{item.section}}</option>
                  </select>
                  <span id="section_msg" class="error_message">The Available for field is required</span>
                </div>
              </div>
              <div class="col-12">
                <label for="uploadDate">Upload Date</label>
                <input type="date" class="inputbox" id="uploadDate" v-model="uploadContent.date" />
              </div>
              <div class="col-12">
                <label for="Description">Description</label>
                <br />
                <textarea class="textareas" id="Description" rows="3" autocomplete="off" v-model="uploadContent.description"></textarea>
              </div>
              <div class="col-12">
                <label for="contentFile">
                  Content File
                  <strong>*</strong>
                </label>
                <input type="file" class="inputbox" @change="changeContentFile()" id="contentFile" ref="contentFile"/>
                <span id="contentFile_msg" class="error_message">Content type is required</span>
              </div>
              <div class="col-12">
                <button type="submit" class="save btn-dark" id="globalSave">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-md-12 div_very_small" style="padding: 0px;padding-left: 15px;">
        <div class="card">
          <div class="card-header">
            <h6>Content List</h6>
          </div>
          <div class="card-body">
            <message :alertmessage="deletemsg"  id="deletemsg" />
            <input type="text" placeholder="Search..." class="searchText" id="myInput" />
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
                  <div @click="clickBackground()" id="backgroundColumn" style="top: 0;left: 0;width: 100%;height: 100%;background: transparent;"></div>
                </div>
              </div>
            </div>
            <h1 class="NoData" v-if="ContentList.length==0">No Data</h1>
            <div class="table-responsive" id="print">
              <table class="table table-hover table-striped" id="studenttable" v-if="ContentList.length!=0">
                <thead>
                  <tr>
                    <th :class="arrayTableColumns[0].class" nowrap>Content Title</th>
                    <th :class="arrayTableColumns[1].class" nowrap>Type</th>
                    <th :class="arrayTableColumns[2].class" nowrap>Date</th>
                    <th :class="arrayTableColumns[3].class" nowrap>Available For</th>
                    <th :class="arrayTableColumns[4].class" nowrap>Class</th>
                    <th :class="arrayTableColumns[5].class" nowrap style="text-align:right;">Action</th>
                  </tr>
                </thead>
                <tbody id="myTable">
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
  data() 
  {
    return {
      arrayTableColumns: [
        {"Name": "Content Title","Id": "Content_Id", "class": "tbl_body_Content"},
        {"Name": "Type","Id": "Type_Id", "class": "tbl_body_Type"},
        {"Name": "Date","Id": "Date_Id", "class": "tbl_body_Date"},
        {"Name": "Available For","Id": "Available_Id", "class": "tbl_body_Available"},
        {"Name": "Class","Id": "Class_Id", "class": "tbl_body_Class"},
        {"Name": "Action","Id": "Action_Id", "class": "tbl_body_Action"}
      ],
      uploadContent: {
        "title": "","type": "","class": "","section": "","date": new Date().toISOString().substr(0, 10),
        "description": "","contentFile": ""
      },
      typeList : [
        {'value':'Assignments','caption':'Assignments'},
        {'value':'Study Material','caption':'Study Material'},
        {'value':'Syllabus','caption':'Syllabus'},
        {'value':'Other Download','caption':'Other Download'},
      ],
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
      classDisabled : true,
      sectionDisabled : true,
      AvailableDisabled : true,
      checkStudent : false,
      checkAdmin: false,
      checkAvailable : false,
      Available : [],
      ClassList: [],
      ClassSessionList: [],
      ContentList: [],
      SectionList: [],
    };
  },
  mounted() {
      EventBus.$emit("onLoad");
  },
  created() 
  {
    EventBus.$emit("ThemeClicked");
    EventBus.$on("clicked", response => {
      this.getContent();
      this.deletemsg.text = response.text;
      this.deletemsg.type = response.type;
      Util.workAlert('#deletemsg');
    });
    this.getAllClass();
    this.getContent();
  },
  
  methods: {
    // Get Content
    getContent(){
      EventBus.$emit("onLoad");
      this.ContentList = [];
      this.axios.get('/api/content').then(response => {
        this.ContentList = response.data;
        EventBus.$emit("onLoadEnd");
      });
    },
    // Get Class And 
    getAllClass(){
      this.axios.get('/api/class').then(response => {
        this.ClassSessionList = response.data;
        this.sortList(response.data);
      });
    },
    sortList(aList){       
      for(let i=0; i < aList.length; i++){
        if(this.ClassList == [] || this.ClassList.length == 0){
            let obj = [];
            obj.push({"id": aList[i].sectionid,"section": aList[i].section});
            this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj});
        }else{
            let check = 0;
            for(let a=0; a < this.ClassList.length; a++){
                if(this.ClassList[a].class == aList[i].class){              
                this.ClassList[a].section.push({"id": aList[i].sectionid,"section": aList[i].section});
                check = 1;
                }            
            }
            if(check == 0){
                let obj1 = [];
                obj1.push({"id": aList[i].sectionid,"section": aList[i].section});
                this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj1});
            }
        }
      }

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
    // Content File Change
    changeContentFile(){
      if(this.$refs.contentFile.files[0] != undefined){
        document.getElementById('contentFile_msg').style.display = "none";
      }
    },
    CheckboxStudent(checkStudent) {
      if (checkStudent) {
        $("#classCol").css("background-color", "transparent");
          this.classDisabled = false;
          this.sectionDisabled = false;
          this.AvailableDisabled = false;
      } else {
        $("#classCol").css("background-color", "#eae6e6");
        this.sectionDisabled = true;
        this.classDisabled = true;
        this.AvailableDisabled = true;
        this.checkAvailable = false;
        this.StyleClassAndSection();
      }
    },
    CheckboxAvailable(checkAvailable) {
      if (checkAvailable) {
        this.classDisabled = true;
        this.sectionDisabled = true;
        this.StyleClassAndSection();
      }else{
        this.classDisabled = false;
        this.sectionDisabled = false;
      }
    },
    StyleClassAndSection(){
        this.uploadContent.class = "";
        this.uploadContent.section = "";
        this.onValidate("1", 'class_id', 'class_msg');
        this.onValidate("1", 'section_id', 'section_msg');
    },

    click_checkbox(e, id){
      if(e.target.checked)
      {
        this.Available.push(id);
        $('#available_msg').css('display', 'none');                    
      }
      else
      {
        this.Available.splice(this.Available.map(item => item).indexOf(id), 1);
        if(this.Available == []|| this.Available.length == 0 || this.Available == undefined)
        {
          $('#available_msg').css('display', 'block');
        }
      }      
    },

    selectClass(){
      this.onValidate(this.uploadContent.class, 'class_id', 'class_msg');
      this.SectionList = [];
      this.uploadContent.section = "";
      for(let i = 0;i < this.ClassList.length;i++){
          if(this.ClassList[i].id === this.uploadContent.class){
              this.SectionList = this.ClassList[i].section;
          }
      }
    },

    checkValidate()
    {
      let checkValue = true;
      if(this.uploadContent.title == "" || this.uploadContent.title == undefined){
        checkValue = false;
        Util.onValidateMessage('content', 'title_msg');
      }
      if(this.uploadContent.type == "" || this.uploadContent.type == undefined){
        checkValue = false;
        Util.onValidateMessage('type', 'type_msg');
      }
      if(this.Available == []|| this.Available.length == 0 || this.Available == undefined)
      {
        checkValue = false;
        $('#available_msg').css('display', 'block');
      }
      if(this.uploadContent.contentFile == "" || this.uploadContent.contentFile == undefined){
        checkValue = false;
        document.getElementById('contentFile_msg').style.display = "block";
      }
      if(this.checkStudent && !this.checkAvailable){
        if(this.uploadContent.class == "" || this.uploadContent.class == undefined){
          checkValue = false;
          Util.onValidateMessage('class_id', 'class_msg');
        }
        if(this.uploadContent.section == "" || this.uploadContent.section == undefined){
          checkValue = false;
          Util.onValidateMessage('section_id', 'section_msg');
        }
      }
      return checkValue;
    },

    goSave() 
    { 
      this.uploadContent.contentFile = this.$refs.contentFile.files[0];
      if(this.checkValidate()){
        let formData = new FormData();
      formData.append("title", this.uploadContent.title);
      formData.append("type", this.uploadContent.type);
      formData.append("Available", this.Available.toString());
      formData.append("class_section", this.checkAvailable);
      formData.append("class", this.uploadContent.class);
      formData.append("section", this.uploadContent.section);
      formData.append("class", this.uploadContent.class);
      formData.append("date", this.formatDate(this.uploadContent.date));
      formData.append("description", this.uploadContent.description);
      formData.append("contentFile", this.uploadContent.contentFile);
      const config = {
        headers: { "content-type": "multipart/form-data" }
      };
      this.axios.post('/api/content/save', formData,config)
      .then(response => {
        this.msg.text = response.data.text;
        this.msg.type = response.data.type;
        Util.workAlert('#alertmsg');
        if(response.data.type == 'success'){
          this.clearTextBox();
        }
      }).catch(error => {            
          console.log("err->" + JSON.stringify(this.error.response));
      });
      }
    },

    //Delete Conteent
    goDelete(aID){
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `content/${funName}/${aID}`;
    },
    onValidate(value, inputId, megId)
    {
      Util.onValidate(value, inputId, megId);
    },

    printme(table)
    {
        Util.printme(table);
    },

    downloadExcel(table, name, filename) 
    {
        Util.downloadExcel(table,name,filename);
    },

    forceFileDownload(response, name)
    {
      const url = window.URL.createObjectURL(new Blob([response.data]))
      const link = document.createElement('a')
      link.href = url
      link.setAttribute('download', name) //or any other extension
      document.body.appendChild(link)
      link.click()
    },

    downloadFile(name)
    {
      let src = 'aaa/' + name;
      axios({ method: 'get', url: src, responseType: 'arraybuffer' }).then(response => 
      {
        this.forceFileDownload(response, name);
      })
      .catch(() => console.log('error occured'));
    },
    clearTextBox(){
      this.getContent();
      this.classDisabled = true;
      this.sectionDisabled = true;
      this.AvailableDisabled = true;
      this.checkStudent = false;
      this.checkAvailable = false;
      this.checkAdmin = false;
      this.Available = [];
      this.SectionList = [];
      this.$refs.contentFile.value = '';
      $("#classCol").css("background-color", "#eae6e6");
      this.uploadContent= {
        "title": "","type": "","class": "","section": "","date": new Date().toISOString().substr(0, 10),
        "description": "","contentFile": ""
      };
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
    // Save Date Format
    formatDate(date){
      let year = date.substring(0, 4);
      let month = date.substring(5, 7);
      let day = date.substring(8, 10);
      return year + month + day;
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
};
</script>

<style>
@media (max-width: 991px) and (min-width: 0px){
    .div_very_small{
        padding: 0px !important;
    }
}
</style>
