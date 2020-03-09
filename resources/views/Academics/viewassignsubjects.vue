<template>
  <div class="form" id="bar">
    <div class="toplink">
      <h2 class="stuName">Academics</h2>
      <h4 class="stuLink">
        <router-link to="/dashboard" class="home">Home</router-link> > Assign Subjects
      </h4>
    </div>
    <hr style="margin-bottom: -0.5rem;" />

    <confirm :url="props"></confirm>
    <Loading></Loading>
    <div class="card">
      <div class="card-header">
        <h6>Select Criteria</h6>
        <router-link to="/asssubjects" onclick="showForm()" class="add">Add</router-link>
      </div>
      <div class="card-body">
        <div class="row" id="row" style="margin: 0px;">
          <div class="col-lg-6 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Class
              <strong>*</strong>
            </label>
            <select
              id="classid"
              @change="changeClass(AssSubject.class_id)"
              class="inputbox"
              name="class"
              v-model="AssSubject.class_id"
            >
              <option
                v-for="Classes in ClassList"
                :key="Classes.id"
                :value="Classes.id"
              >{{Classes.class}}</option>
            </select>
            <span id="classmsg" class="error_message">Class is required</span>
          </div>
          <div class="col-lg-6 col-md-6 col-12 textbox">
            <label for="name" class="title">
              Section
              <strong>*</strong>
            </label>
            <select
              id="sectionid"
              @change="changeSection(AssSubject.section_id)"
              class="inputbox"
              name="class"
              v-model="AssSubject.section_id"
            >
              <option
                v-for="Section in SectionList"
                :key="Section.id"
                :value="Section.id"
              >{{Section.section}}</option>
            </select>
            <span id="sectionmsg" class="error_message">Section is required</span>
          </div>
          <div class="col-12 column-12">
            <button @click="goSearch()" class="searchButton" id="globalSearch">Search</button>

            <button @click="ShowAll()" class="searchButton" id="globalSearch">Show All</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showall" class="card">
      <div class="card-header">
        <h6>Assign Subject List</h6>
      </div>
      <div class="card-body">
        <message :alertmessage="msg" id="alertmsg" />
        <message :alertmessage="deletemsg" id="delalertmsg" />
        <input type="text" placeholder="Search..." class="searchText" />
        <div class="copyRows">
          <div class="row" id="copyRow">
            <div class="col-3">
              <a href="#" title="Excel">
                <i class="fa fa-file-excel-o"></i>
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
        <div v-if="AssSubList.length == 0">
            <h1 class="NoData">No Data</h1>
        </div>
        <div v-if="AssSubList.length != 0" class="table-responsive">          
          <table class="table table-hover" id="studenttable">
            <thead>
              <tr>
                <th class="all" nowrap>Class</th>
                <th class="all" nowrap>Section</th>
                <th class="all" nowrap>Total Subject</th>
                <th class="all" style="text-align:right;" nowrap>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="obj in AssSubList" :key="obj.id" class="active">
                <td class="all" nowrap>{{obj.class}}</td>
                <td class="all" nowrap>{{obj.section}}</td>
                <td class="all" nowrap>{{obj.AssignSubObj.length}}</td>
                <td style="text-align:right;vertical-align:top;">
                  <i @click="goDetail(obj)" class="fa fa-list pen">
                    <span class="penLabel">Detail</span>
                  </i>
                  <i @click="goEdit(obj.AssignSubObj)" class="fa fa-pencil pen">
                    <span class="penLabel">Edit</span>
                  </i>
                  <i
                    @click="goDelete(obj.AssignSubObj)"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                    class="fa fa-trash time"
                  >
                    <span class="timeLabel">Delete</span>
                  </i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal" id="DetailAssSubject">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-media-content">
          <div class="sub-header" style="padding: 0px 15px;margin: 0px;">
            <h6>Detail Assign Subject</h6>
            <i class="fa fa-times time modal_close_btn" data-dismiss="modal"></i>
          </div>
          <div class="modal-body" style="padding: 10px 0px;">
            <div class="row" id="row" style="margin: 0px;">
              <div class="col-lg-6 col-12 textbox">
                <div
                  class="col-lg-3 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <label for="name" class="title">Class</label>
                </div>
                <div
                  class="col-lg-7 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <select class="inputbox" name="class" disabled>
                    <option>{{classname}}</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-12 textbox">
                <div
                  class="col-lg-3 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <label for="name" class="title">Section</label>
                </div>
                <div
                  class="col-lg-7 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <select class="inputbox" name="class" disabled>
                    <option>{{sectionname}}</option>
                  </select>
                </div>
              </div>
            </div>

            <div
              v-for="assSub in AssSubObj"
              :key="assSub.id"
              class="row"
              id="row"
              style="margin: 0px;"
            >
              <div class="col-lg-6 col-12 textbox">
                <div
                  class="col-lg-3 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <label for="name" class="title">{{ assSub.SubCaption }}</label>
                </div>
                <div
                  class="col-lg-7 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <select class="inputbox" name="class" v-model="assSub.SubValue" disabled>
                    <option
                      v-for="sublist in SubjectList"
                      :key="sublist.id"
                      :value="sublist.id"
                    >{{getSubjectName(sublist.name,sublist.type)}}</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-12 textbox">
                <div
                  class="col-lg-3 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <label for="name" class="title">{{ assSub.TeacherCaption }}</label>
                </div>
                <div
                  class="col-lg-7 col-12"
                  style="display: inline-block;padding: 0px;margin: 0px;"
                >
                  <select class="inputbox" name="class" v-model="assSub.TeacherValue" disabled>
                    <option
                      v-for="teachlist in TeacherList"
                      :key="teachlist.id"
                      :value="teachlist.id"
                    >{{teachlist.name}}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="padding: 10px 15px;">
            <button
              class="save btn-dark"
              id="globalSave"
              style="margin: 0px;"
              data-dismiss="modal"
            >Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import message from "../Alertmessage/message.vue";
import Loading from "../LoadingController.vue";
import confirm from "../message/confirm.vue";

import { EventBus } from "../../js/event-bus.js";
import store from "store2";
import { Util } from "../../js/util";

export default {
  components: {
    confirm,
    Loading,
    message
  },
  data() {
    return {
      AssSubject: { id: "", class_id: "", section_id: "" },
      ClassList: [
        {
          id: 0,
          class: "Select Class",
          section: [{ id: 0, section: "Class Section" }]
        }
      ],
      SectionList: [{ id: 0, section: "Class Section" }],
      SubjectList: [{ id: 0, name: "Select Subject", type: "" }],
      TeacherList: [],

      AssSubList: [],
      showall: false,
      sectionname: "",
      classname: "",
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

      AssSubObj: [
        {
          id: "",
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
    EventBus.$on("clicked", response => {
      this.deletemsg.text = response.text;
      this.deletemsg.type = response.type;
      Util.workAlert("#delalertmsg");
      this.getAllClass();
      this.getAllSubject();
      this.ShowAll();
    });
    EventBus.$on("SessionSaved", response => {
      console.log(JSON.stringify(response));
      this.ClassList = [
        {
          id: 0,
          class: "Select Class",
          section: [{ id: 0, section: "Class Section" }]
        }
      ];
      this.SectionList = [{ id: 0, section: "Class Section" }];
      this.getAllClass();
      this.getAllSubject();
    });

    var message = store.get("msg");
    if (message != null) {
      this.ShowAll();
      if (message == "save") {
        this.msg.text = "Assign Subject added successfully";
        this.msg.type = "success";
      } else {
        this.msg.text = "Assign Subject updated successfully";
        this.msg.type = "success";
      }
      Util.workAlert("#alertmsg");
    }
    store.clearAll();
    this.getAllClass();
    this.getAllSubject();
    this.getTeacherList();
  },
  mounted() {
    EventBus.$emit("onLoad");
  },
  methods: {
    getAllSubject() {
      this.axios.get("/api/subject").then(response => {
        for (let i=0; i<response.data.length; i++) {
          this.SubjectList.push({
            id: response.data[i].id,
            name: response.data[i].name,
            type: response.data[i].type
          });
        }
        if(this.SubjectList.length != 0)    this.AssSubObj[0].SubValue = this.SubjectList[0].id;
      });
    },

    getTeacherList() {
      this.axios.get("/api/designations").then(
          response => {
              for(let i=0; i<response.data.length; i++){
                  this.TeacherList.push({"id": response.data[i].id, "name": response.data[i].designation_name, "checked": false});
              }
              console.log(JSON.stringify(this.TeacherList));
              if(this.TeacherList.length != 0)  this.AssSubObj[0].TeacherValue = this.TeacherList[0].id;
          });
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
      this.AssSubject.class_id = this.ClassList[0].id;
      this.AssSubject.section_id = this.SectionList[0].id;
      EventBus.$emit("onLoadEnd");
    },

    getSubjectName(aName, aType) {
      if (aType == "") return aName;
      else return aName + " " + "(" + aType + ")";
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
      if (this.AssSubject.class_id == 0) {
        $("#classid").css("border", "1px solid red");
      } else {
        $("#classmsg").css("display", "none");
        $("#classid").css("border", "1px solid #d2d6de");
      }
    },

    changeSection(aId) {
      if (aId == 0) $("#sectionid").css("border", "1px solid red");
      else {
        $("#sectionmsg").css("display", "none");
        $("#sectionid").css("border", "1px solid #d2d6de");
      }
    },

    checkValidate() {
      var returnValue = true;
      if (
        this.AssSubject.class_id == "" ||
        this.AssSubject.class_id == undefined ||
        this.AssSubject.class_id == 0
      ) {
        $("#classmsg").css("display", "block");
        $("#classid").css("border", "1px solid red");
        returnValue = false;
      }
      if (
        this.AssSubject.section_id == "" ||
        this.AssSubject.section_id == undefined ||
        this.AssSubject.section_id == 0
      ) {
        $("#sectionmsg").css("display", "block");
        $("#sectionid").css("border", "1px solid red");
        returnValue = false;
      }
      return returnValue;
    },

    goSearch() {
      if (this.checkValidate()) {
        EventBus.$emit("onLoad");
        EventBus.$emit("ThemeClicked");
        this.showall = true;
        this.axios
          .post("/api/AssSubject/search", this.AssSubject)
          .then(response => {
            this.AssSubSort(response.data);            
          });
      }
    },

    ShowAll() {
      EventBus.$emit("onLoad");
      this.axios.get("/api/asssubject").then(response => {
        this.AssSubSort(response.data);
        this.showall = true;
        EventBus.$emit("ThemeClicked");
        this.AssSubject.class_id = this.ClassList[0].id;
        this.AssSubject.section_id = this.SectionList[0].id;
        EventBus.$emit("onLoadEnd");
      });
    },

    AssSubSort(alist) {
      this.AssSubList = [];
      for (let i = 0; i < alist.length; i++) {
        if (this.AssSubList == [] || this.AssSubList.length == 0) {
          let asssubobj = [];
          asssubobj.push({
            id: alist[i].AssSubId,
            SubId: alist[i].subject_id,
            StaffId: alist[i].staff_id
          });
          this.AssSubList.push({
            classid: alist[i].classid,
            class: alist[i].class,
            sectionid: alist[i].sectionid,
            section: alist[i].section,
            AssignSubObj: asssubobj
          });
        } else {
          let acheck = 0;
          for (let a = 0; a < this.AssSubList.length; a++) {
            if (
              this.AssSubList[a].classid == alist[i].classid &&
              this.AssSubList[a].sectionid == alist[i].sectionid
            ) {
              this.AssSubList[a].AssignSubObj.push({
                id: alist[i].AssSubId,
                SubId: alist[i].subject_id,
                StaffId: alist[i].staff_id
              });
              acheck = 1;
            }
          }

          if (acheck == 0) {
            let asssubobj1 = [];
            asssubobj1.push({
              id: alist[i].AssSubId,
              SubId: alist[i].subject_id,
              StaffId: alist[i].staff_id
            });
            this.AssSubList.push({
              classid: alist[i].classid,
              class: alist[i].class,
              sectionid: alist[i].sectionid,
              section: alist[i].section,
              AssignSubObj: asssubobj1
            });
          }
        }
      }
      EventBus.$emit("onLoadEnd");
    },

    goDetail(aObj) {
      this.AssSubObj = [];
      this.sectionname = "";
      this.classname = "";

      for (let i = 0; i < aObj.AssignSubObj.length; i++) {
        this.AssSubObj.push({
          id: aObj.AssignSubObj[i].id,
          itemid: i + 1,
          SubCaption: "Subject",
          SubValue: aObj.AssignSubObj[i].SubId,
          TeacherCaption: "Teacher",
          TeacherValue: aObj.AssignSubObj[i].StaffId
        });
      }
      this.classname = aObj.class;
      this.sectionname = aObj.section;
      $("#DetailAssSubject").modal();
    },

    goEdit(aObj) {
      this.$router.push({
        name: "editassSubjects",
        params: { id: aObj[0].id }
      });
    },

    goDelete(aObj) {
      var aID = aObj[0].id;
      var funName = "delete"; /**Delete function */
      this.props.type = "delete";
      this.props.url = `AssSubject/${funName}/${aID}`;
    }
  }
};
</script>