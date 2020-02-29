<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <router-link class="home" to="home">Home</router-link>>
        <router-link class="home" to="/viewasssubjects">Assign Subject</router-link>> Edit Assign Subject
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <div class="card">
      <div class="card-header">
        <h6>Assign Subject</h6>        
      </div>
      <div class="card-body">
        
        <message :alertmessage="msg" />

        <div class="row" id="row" style="padding-bottom: 0px;">
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">
                Class
                <strong>*</strong>
              </label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px;">
              <select @change="changeClass(AssSubject.class_id)" class="inputbox" name="class" v-model="AssSubject.class_id">
                <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">
                Section
                <strong>*</strong>
              </label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px;">
              <select class="inputbox" name="class" v-model="AssSubject.section_id">
                <option v-for="Section in SectionList" :key="Section.id" :value="Section.id" >{{Section.section}}</option>
              </select>
            </div>
          </div>
        </div>

        <div v-for="assSub in AssSubObj" :key="assSub.id" class="row" id="row" style="padding-bottom: 0;">
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ assSub.SubCaption }}</label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px;">
              <select class="inputbox" name="class" v-model="assSub.SubValue">
                <option v-for="sublist in SubjectList" :key="sublist.id" :value="sublist.id" >{{getSubjectName(sublist.name,sublist.type)}}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-12 textbox" style="display: flex;flex-wrap: wrap;">
            <div class="col-lg-3 col-12" style="padding-left: 5px;padding-right: 5px;">
              <label for="name" class="title">{{ assSub.TeacherCaption }}</label>
            </div>
            <div class="col-lg-7 col-12" style="padding-left: 5px;padding-right: 5px; margin-bottom: 5px;" >
              <select class="inputbox" name="class" v-model="assSub.TeacherValue">
                <option v-for="teachlist in TeacherList" :key="teachlist.id" :value="teachlist.id" >{{teachlist.name}}</option>
              </select>
            </div>
            <div class="col-lg-2 col-12" style="padding-left: 5px;padding-right: 5px;">
              <button @click="DeleteRow(assSub.itemid)" class="btnTrash">
                <i class="fa fa-trash btnIcon" aria-hidden="true"></i>
              </button>
              <button v-if="assSub.itemid == l_newlastItemId" @click="AddRow()" class="btnAdd">                
                <i class="fa fa-plus btnIcon" aria-hidden="true"></i>
              </button>
            </div>            
          </div>
        </div>
        <hr />
        <div class="col-12">
          <button @click="goSave()" id="globalSave" class="save" style="margin:0 0 1rem;">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import message from "../Alertmessage/message.vue";
import store from "store2";
export default {
  components: {      
      message
  },
  data() {
    return {
      AssSubject: {
        id: "",
        class_id: "",
        section_id: "",
        assignSubject: [],
        delRecord: []
      },
      ClassList: [
        {
          id: 0,
          class: "Select Class",
          section: [{ id: 0, section: "Class Section" }]
        }
      ],
      SectionList: [{ id: 0, section: "Class Section" }],
      SubjectList: [{ id: 0, name: "Select Subject", type: "" }],
      TeacherList: [
        { id: 0, name: "Select Teacher" },
        { id: 1, name: "Shivam" },
        { id: 2, name: "Jason" }
      ],      

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
      ],
      l_newlastItemId: "",
      msg: {
        text: "",
        type: ""
      },
    };
  },
  created() {    
    this.getAllClass();
    this.getAllSubject();    
  }, 
  methods: {
    getEditAssSub(){      
      this.axios.get(`/api/AssSubject/editsearch/${this.$route.params.id}`).then(response => {        
        this.AssSubObj = [];
        for(let i=0; i<response.data.assSubject.length; i++){
            this.AssSubObj.push({id: response.data.assSubject[i].id,itemid: i+1,SubCaption: "Subject",SubValue: response.data.assSubject[i].subject_id,TeacherCaption: "Teacher",TeacherValue: response.data.assSubject[i].staff_id});
        }        
        this.l_newlastItemId = this.AssSubObj[0].itemid;
        this.AssSubject.class_id = response.data.classSection.class_id;
        for(let i=0; i<this.ClassList.length;i++){
          if(this.ClassList[i].id == response.data.classSection.section_id){
            for(let a=0; a<this.ClassList[i].section.length; a++){
              this.SectionList.push(this.ClassList[i].section[a]);
            }
            break;
          }
        }
        this.AssSubject.section_id = response.data.classSection.section_id;        
      });
    },

    getAllSubject() {
      this.axios.get("/api/subject").then(response => {
        for (let i = 0; i < response.data.length; i++) {
          this.SubjectList.push({
            id: response.data[i].id,
            name: response.data[i].name,
            type: response.data[i].type
          });
        }
        this.AssSubObj[0].SubValue = this.SubjectList[0].id;
        this.AssSubObj[0].TeacherValue = this.TeacherList[0].id;
      });
    },

    getSubjectName(aName, aType) {
      if (aType == "") return aName;
      else return aName + " " + "(" + aType + ")";
    },

    getAllClass() {
      this.axios.get("/api/class").then(response => {
        this.sortList(response.data);
        this.getEditAssSub();
      });
    },

    sortList(aList) {
      for (let i = 0; i < aList.length; i++) {
        if (this.ClassList == [] || this.ClassList.length == 0) {
          let obj = [];
          obj.push({ id: aList[i].sectionid, section: aList[i].section });
          this.ClassList.push({
            id: aList[i].classid,
            class: aList[i].class,
            section: obj
          });
        } else {
          let check = 0;
          for (let a = 0; a < this.ClassList.length; a++) {
            if (this.ClassList[a].class == aList[i].class) {
              this.ClassList[a].section.push({
                id: aList[i].sectionid,
                section: aList[i].section
              });
              check = 1;
            }
          }

          if (check == 0) {
            let obj1 = [];
            obj1.push({ id: aList[i].sectionid, section: aList[i].section });
            this.ClassList.push({
              id: aList[i].classid,
              class: aList[i].class,
              section: obj1
            });
          }
        }
      }
    },

    changeClass(aId) {
      this.SectionList = [];
      this.SectionList = [{ id: 0, section: "Class Section" }];
      if (aId != 0) {
        for (let i = 0; i < this.ClassList.length; i++) {
          if (this.ClassList[i].id == aId) {
            for (let a = 0; a < this.ClassList[i].section.length; a++) {
              this.SectionList.push(this.ClassList[i].section[a]);
            }
            break;
          }
        }
      }
      this.AssSubject.section_id = this.SectionList[0].id;
    },

    goSave() {
      this.AssSubject.delRecord = this.DeleteRecord;
      this.AssSubject.assignSubject = this.AssSubObj;      
      this.axios
        .post("/api/AssSubject/edit", this.AssSubject)
        .then(response => {          
          this.DeleteRecord = [];
          if(response.data.type == "error"){
            this.msg.text = response.data.text;
            this.msg.type = response.data.type;
          }
          else{
            this.$router.push({name: 'viewasssubjects'});
            store.set("msg","update");
          }          
        });
    },

    AddRow() {
      this.AssSubObj.push({ aID: 0, itemid: Number(this.AssSubObj[this.AssSubObj.length - 1].itemid + 1), SubCaption: "Subject", SubValue: "", TeacherCaption: "Teacher", TeacherValue: "" });
      this.AssSubObj[this.AssSubObj.length - 1].SubValue = this.SubjectList[0].id;
      this.AssSubObj[this.AssSubObj.length - 1].TeacherValue = this.TeacherList[0].id;      
      this.l_newlastItemId = this.AssSubObj[0].itemid;
    },

    DeleteRow(aValue) {
      if (this.AssSubObj.length != 1) {
        for (let i = 0; i < this.AssSubObj.length; i++) {
          if (aValue == this.AssSubObj[i].itemid) {
            this.DeleteRecord.push(this.AssSubObj[i]);
            this.AssSubObj.splice(i, 1);            
            this.l_newlastItemId = this.AssSubObj[0].itemid;
            break;
          }
        }
      }
    }
  }
};
</script>