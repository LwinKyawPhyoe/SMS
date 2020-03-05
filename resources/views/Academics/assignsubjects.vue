<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <router-link class="home" to="home">Home</router-link> > 
        <router-link class="home" to="/viewasssubjects">Assign Subject</router-link> > Create Assign Subject
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
      </div>
      <div class="card-body">
        <form @submit.prevent="goSearch">
          <div class="row" id="row" style="margin: 0px;">        
            <div class="col-lg-6 col-md-6 col-12 textbox">
              <label for="name" class="title">
                Class
                <strong>*</strong>
              </label>            
              <select id="classid" @change="changeClass(AssSubject.class_id)" class="inputbox" name="class" v-model="AssSubject.class_id">                              
                  <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
              </select>
              <span id="classmsg" class="error_message">Class is required</span>
            </div>
            <div class="col-lg-6 col-md-6 col-12 textbox">
              <label for="name" class="title">
                Section
                <strong>*</strong>
              </label>
              <select id="sectionid" @change="changeSection(AssSubject.section_id)" class="inputbox" name="class" v-model="AssSubject.section_id">
                <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
              </select>
              <span id="sectionmsg" class="error_message">Section is required</span>
            </div>
            <div class="col-12">              
              <button type="submit" class="searchButton" id="globalSearch">Search</button>
            </div>          
          </div>
        </form>
      </div>

      <div v-if="haveRecord" class="sub-header">
        <h6>Assign Subject</h6>
        <button @click="AddRow()" class="add">Add</button>
      </div>
      <div v-if="haveRecord" class="card-body">
        <div v-for="assSub in AssSubObj" :key="assSub.id" class="row" id="row" style="padding-bottom: 0;">
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ assSub.SubCaption }}</label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px;">
              <select class="inputbox" name="class" v-model="assSub.SubValue">
                <option v-for="sublist in SubjectList" :key="sublist.id" :value="sublist.id">{{getSubjectName(sublist.name,sublist.type)}}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ assSub.TeacherCaption }}</label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px; margin-bottom: 5px;">
              <select class="inputbox" name="class" v-model="assSub.TeacherValue">
                <option v-for="teachlist in TeacherList" :key="teachlist.id" :value="teachlist.id">{{teachlist.name}}</option>
              </select>
            </div>
            <div class="col-lg-2 col-12" style="padding-left: 5px;padding-right: 5px;">
              <button @click="DeleteRow(assSub.itemid)" class="btnTrash">
                <i class="fa fa-trash btnIcon" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
        <hr />
        <div class="col-12">          
          <button @click="goSave()" class="save" id="globalSave" style="margin:0 0 1rem;">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "../LoadingController.vue";
import { EventBus } from "../../js/event-bus.js";
import store from "store2";
export default {
  components: {
    Loading
  },
  data() {
    return {
      AssSubject: {"id":"", "class_id": "", "section_id": "", "assignSubject": [], "delRecord": []},
      ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}],
      SectionList: [{"id":0,"section":"Class Section"}],
      SubjectList: [{"id":0,"name":"Select Subject","type": ""}],
      TeacherList: [],
      haveRecord: false,

      TeacherList: [],
      designation: [],

      DeleteRecord: [],
      AssSubObj: [
        {
          aID: 0,
          itemid: 1,
          SubCaption: "Subject",
          SubValue: "",
          TeacherCaption: "Teacher",
          TeacherValue: ""
        }
      ]
    };
  },
  created() {
    EventBus.$emit("ThemeClicked");    
    this.getAllClass();
    this.getAllSubject();
    this.getTeacherList();
  },
  mounted() {
    EventBus.$emit("onLoad");
  }, 
  methods: {
    getTeacherList() {
        this.axios.get("/api/designations").then(
            response => {
                for(let i=0; i<response.data.length; i++){
                    this.designation.push({"id": response.data[i].id, "name": response.data[i].designation_name, "checked": false});
                }
                console.log(JSON.stringify(this.designation));
            });
    },

    getAllSubject(){
      this.axios
        .get('/api/subject')
        .then(response => {
            for(let i=0; i<response.data.length; i++){
              this.SubjectList.push({"id": response.data[i].id, "name": response.data[i].name, "type": response.data[i].type});
            }
            this.AssSubObj[0].SubValue = this.SubjectList[0].id;            
        });
    },

    getSubjectName(aName, aType){
      if(aType == "")   return aName;
      else    return aName+" "+"("+aType+")";
    },

    getAllClass() {
      this.axios.get("/api/class").then(response => {
        let array = response.data.sort((a, b) => {
            if (a.sectionid > b.sectionid) {
                return 1;
            }
            if (a.sectionid < b.sectionid) {
                return -1;
            }
            return 0;
        });
        this.sortList(array);
      });
    },

    sortList(aList){       
      for(let i=0; i < aList.length; i++){
        if(this.ClassList == [] || this.ClassList.length == 0){
          let obj = [];
          obj.push({"id": aList[i].sectionid, "section": aList[i].section});
          this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj});
        }
        else{
          let check = 0;
          for(let a=0; a < this.ClassList.length; a++){
            if(this.ClassList[a].class == aList[i].class){              
              this.ClassList[a].section.push({"id": aList[i].sectionid, "section": aList[i].section});
              check = 1;
            }
          }

          if(check == 0)
          {
            let obj1 = [];
            obj1.push({"id": aList[i].sectionid, "section": aList[i].section});
            this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj1});
          }
        }
      }
      this.AssSubject.class_id = this.ClassList[0].id;
      this.AssSubject.section_id = this.SectionList[0].id;
      EventBus.$emit("onLoadEnd");
    },

    changeClass(aId){
      this.SectionList = [];
      this.SectionList = [{"id":0,"section":"Class Section"}];
      if(aId != 0)
      {
        for(let i=0; i<this.ClassList.length;i++){
          if(this.ClassList[i].id == aId){
            for(let a=0; a<this.ClassList[i].section.length; a++){
              this.SectionList.push(this.ClassList[i].section[a]);
            }
            break;
          }
        }
      }
      this.AssSubject.section_id = this.SectionList[0].id;
      this.haveRecord = false;
      this.AssSubObj = [{aID: 0, itemid: 1, SubCaption: "Subject", SubValue: "", TeacherCaption: "Teacher", TeacherValue: ""}];
      if(this.AssSubject.class_id == 0)
      {
          $('#classid').css('border', '1px solid red');
      }
      else
      {
          $('#classmsg').css('display', 'none');
          $('#classid').css('border', '1px solid #d2d6de');
      }
    },

    changeSection(aId)
    {      
      this.axios.post('/api/ClassTeacher/search', this.AssSubject).then(response => {      
          console.log(JSON.stringify(response.data));
          if(response.data == [] || response.data.length == 0){
            this.TeacherList = [{"id": 0, "name": "Select Teacher"}];
          }
          else
          {
            let staffAry = [];
            staffAry = response.data[0].staff_id.split(",");          
            this.TeacherList = [{"id": 0, "name": "Select Teacher"}];
            for(let i=0; i<staffAry.length; i++){
              for(let a=0; a<this.designation.length; a++){
                if(Number(staffAry[i]) == this.designation[a].id){
                  this.TeacherList.push({"id": this.designation[a].id, "name": this.designation[a].name});
                }
              }
            }
          }
          this.AssSubObj[0].TeacherValue = this.TeacherList[0].id;
      }); 
      this.haveRecord = false;
      this.AssSubObj = [{aID: 0, itemid: 1, SubCaption: "Subject", SubValue: "", TeacherCaption: "Teacher", TeacherValue: ""}];
      if(aId == 0)   $('#sectionid').css('border', '1px solid red');
      else
      {
          $('#sectionmsg').css('display', 'none');        
          $('#sectionid').css('border', '1px solid #d2d6de');
      }
    },

    checkValidate()
    {
        var returnValue = true;
        if(this.AssSubject.class_id == "" || this.AssSubject.class_id == undefined || this.AssSubject.class_id == 0)
        {
            $('#classmsg').css('display', 'block');
            $('#classid').css('border', '1px solid red');
            returnValue = false;
        }
        if(this.AssSubject.section_id == "" || this.AssSubject.section_id == undefined || this.AssSubject.section_id == 0)
        {
            $('#sectionmsg').css('display', 'block');
            $('#sectionid').css('border', '1px solid red');
            returnValue = false;
        }            
        return returnValue;
    },

    goSearch() {
      if(this.checkValidate())
      {
        EventBus.$emit("ThemeClicked");
        this.axios.post('/api/AssSubject/search', this.AssSubject).then(response => {        
          if(response.data == "" || response.data == [])
          {
            this.haveRecord = true;
            this.AssSubObj = [{aID: 0, itemid: 1, SubCaption: "Subject", SubValue: 0, TeacherCaption: "Teacher", TeacherValue: 0}]
          }
          else
          {          
            this.AssSubObj = [];
            this.haveRecord = true;
            for(let i=0; i<response.data.length; i++){
              this.AssSubObj.push({aID: response.data[i].AssSubId, itemid: i+1,SubCaption: "Subject",SubValue: response.data[i].subject_id,TeacherCaption: "Teacher",TeacherValue: response.data[i].staff_id});
            }
          }
          EventBus.$emit("ThemeClicked");
        });
      }
    },

    goSave(){
      this.AssSubject.delRecord = this.DeleteRecord;
      this.AssSubject.assignSubject = this.AssSubObj;      
      this.axios.post('/api/AssSubject/save', this.AssSubject).then(response =>{        
        this.DeleteRecord = [];        
        this.$router.push({name: 'viewasssubjects'});
        store.set("msg","save");
      });
    },

    AddRow(){
      this.AssSubObj.push({
        aID: 0,
        itemid: Number(this.AssSubObj[this.AssSubObj.length - 1].itemid + 1),
        SubCaption: "Subject",
        SubValue: "",
        TeacherCaption: "Teacher",
        TeacherValue: ""
      });
      this.AssSubObj[this.AssSubObj.length - 1].SubValue = this.SubjectList[0].id;
      this.AssSubObj[this.AssSubObj.length - 1].TeacherValue = this.TeacherList[0].id;
    },

    DeleteRow(aValue) {
      if (this.AssSubObj.length != 1) {
        for (let i = 0; i < this.AssSubObj.length; i++) {
          if (aValue == this.AssSubObj[i].itemid) {
            this.DeleteRecord.push(this.AssSubObj[i]);
            this.AssSubObj.splice(i, 1);
            break;
          }
        }
      }
    },    
  }
};
</script>