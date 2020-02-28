<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Upload Content</h2>
      <h4 class="stuLink">
        <router-link to="home" class="home">Home</router-link>> Upload Content
      </h4>
    </div>
    <hr />

    <div class="row" style="align-items: end !important;padding-left:10px;">
      <div class="col-lg-4 col-md-12" style="padding-left:0px;">
        <div class="card">
          <div class="card-header">
            <h6>Upload Content</h6>
          </div>
          <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
            <message :alertmessage="msg" />
            <form @submit.prevent="goSave">
              <div class="col-12">
                <label for="contentTitle">Content Title <strong>*</strong></label>
                <input type="text" id="title" class="inputbox" v-model="uploadContent.title"
                    @keyup="onValidate(uploadContent.title, 'title', 'title_msg')" 
                    v-on:blur="onValidate(uploadContent.title, 'title', 'title_msg')" />
                <span id="title_msg" class="error_message">Content title is required</span>
              </div>
              <div class="col-12">
                <label for="typeSection">Content Type <strong>*</strong></label>
                <select id="type" class="inputbox" v-model="uploadContent.type"
                  @change="onValidate(uploadContent.type, 'type', 'type_msg')" >
                    <option v-for="code in typeList" :key="code.value" :value="code.value">{{code.caption}}</option>
                </select>
                <span id="type_msg" class="error_message">Content type is required</span>
              </div>
              <div class="col-12">
                <label for="contentTitle">Available For <strong>*</strong></label>
                <div class="checkbox">
                  <label class="checkboxlabel">
                    <input type="checkbox" class="checkboxinput" 
                      v-model="checkAdmin" @click="click_checkbox($event,1)"/>All Super Admin
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
                        v-model="checkAvailable"/>Available For All Classes
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <label for="classSection">Class</label>
                  <select :disabled="classDisabled" id="classSection" class="inputbox">
                    <option value="1">Class 1</option>
                    <option value="2">Class 2</option>
                  </select>
                </div>
                <div class="col-12">
                  <label for="sectionSection">Section</label>
                  <select :disabled="sectionDisabled" id="sectionSection" class="inputbox">
                    <option value="1">Section 1</option>
                    <option value="2">Section 2</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <label for="uploadDate">Upload Date</label>
                <input type="date" class="inputbox" id="uploadDate" />
              </div>
              <div class="col-12">
                <label for="Description">Description</label>
                <br />
                <textarea class="textareas" id="Description" rows="3" autocomplete="off"></textarea>
              </div>
              <div class="col-12">
                <label for="faPhoto">
                  Content File
                  <strong>*</strong>
                </label>
                <input type="file" class="inputbox" id="faPhoto" />
              </div>
              <div class="col-12">
                <button type="submit" class="save">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-md-12" style="padding-left:0;">
        <div class="card">
          <div class="card-header">
            <h6>Content List</h6>
          </div>
          <div class="card-body">
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
            <div class="table-responsive" id="print">
              <table class="table table-hover table-striped" id="studenttable">
                <thead>
                  <tr>
                    <th class="all" nowrap>Content Title</th>
                    <th class="all" nowrap>Type</th>
                    <th class="all" nowrap>Date</th>
                    <th class="all" nowrap>Available For</th>
                    <th class="all" nowrap>Class</th>
                    <th class="all" nowrap style="text-align:right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="active">
                    <td class="all" nowrap>
                      <p class="toolText">
                        Syllabus for Class 1
                        <span class="tooltipLabel">No Description</span>
                      </p>
                    </td>
                    <td class="all" nowrap>Syllabus</td>
                    <td class="all" nowrap>07/02/2018</td>
                    <td class="all" nowrap>Super Admin</td>
                    <td class="all" nowrap>ALL Classes</td>
                    <td class="all" nowrap style="text-align:right;">
                      <i class="fa fa-download download" @click.prevent="downloadFile('Tran_Route.xls')">
                        <span class="downloadLabel">Download</span>
                      </i>
                      <i class="fa fa-trash time">
                        <span class="timeLabel">Delete</span>
                      </i>
                    </td>
                  </tr>
                  <tr class="active">
                    <td class="all" nowrap>
                      <p class="toolText">
                        Syllabus for Class 2
                        <span class="tooltipLabel">No Description</span>
                      </p>
                    </td>
                    <td class="all" nowrap>Syllabus</td>
                    <td class="all" nowrap>07/02/2018</td>
                    <td class="all" nowrap>Super Admin</td>
                    <td class="all" nowrap>ALL Classes</td>
                    <td class="all" nowrap style="text-align:right;">
                      <i class="fa fa-download download" @click.prevent="downloadFile('php.pdf')">
                        <span class="downloadLabel">Download</span>
                      </i>
                      <i class="fa fa-trash time">
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
import {Util} from '../../js/util';

export default 
{
  components: 
  {
    message
  },

  data() 
  {
    return {
      classDisabled : true,
      sectionDisabled : true,
      checkStudent : false,
      checkAvailable : false,
      uploadContent : {},
      contentList : [],
      typeList : [
        {'value':'','caption':'Select'},
        {'value':'Assignments','caption':'Assignments'},
        {'value':'Study Material','caption':'Study Material'},
        {'value':'Syllabus','caption':'Syllabus'},
        {'value':'Other Download','caption':'Other Download'},
      ],
      msg: {
        text: "",
        type: ""
      },
      deletemsg: {
        text: "",
        type: ""
      },
      arrayError : [],
      Available : [],
    };
  },

  created() 
  {
    this.uploadContent.type = '';
  },
  
  methods: {
    CheckboxStudent(checkStudent) {
      if (checkStudent) {
        $("#classCol").css("background-color", "transparent");
        if (!this.checkAvailable) {
          this.classDisabled = false;
        }
        this.sectionDisabled = false;
      } else {
        $("#classCol").css("background-color", "#eae6e6");
        this.sectionDisabled = true;
        this.classDisabled = true;
      }
    },

    CheckboxAvailable(checkAvailable) {
      if (checkAvailable) {
        this.classDisabled = true;
      } else {
        if (this.checkStudent) {
          this.classDisabled = false;
        }
      }
    },

    click_checkbox(e, id){
      if(e.target.checked)
      {
        this.Available.push(id);
        $('#available_msg').css('display', 'none');                    
      }
      else
      {
        this.Available.splice(this.Available.map(item => item.id).indexOf(id), 1);
        if(this.Available == []|| this.Available.length == 0 || this.Available == undefined)
        {
          $('#available_msg').css('display', 'block')
        }
      }
    },

    checkValidate()
    {
      if(this.tranRoute.title == "" || this.tranRoute.title == undefined)
      {
          Util.onValidateMessage('title', 'title_msg');
          this.arrayError.push('noop');
      }
      if(this.tranRoute.type == "")
      {
          Util.onValidateMessage('type', 'type_msg');
          this.arrayError.push('noop');
      }

      if(this.arrayError.length > 0){
        this.check = false;
      }else{
        this.check = true;
      }
      this.arrayError=[];
    },

    goSave() 
    {
      if(this.checkValidate())
      {
        this.axios.post('/api/TranRoute/save', this.tranRoute).then(response => (              
          this.tranRoute = {"id":"","route_title":"","fare":""},
          this.getRouteList(),
          (this.msg.text = response.data.text),
          (this.msg.type = response.data.type)
        ))
        .catch(error => {            
          console.log("err->" + JSON.stringify(this.error.response))
        });
      }
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
    }
  }
};
</script>
