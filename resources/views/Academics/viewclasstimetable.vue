<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Academics</h2>
            <h4 class="stuLink">
                <a href style="text-decoration:none;color:#1b5e20;">Home</a> > Class TimeTable
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <div class="card">
            <div class="card-header">
                <h6>Select Criteria</h6>
                <router-link to="/timetable" onclick="showForm()" class="add">Add</router-link>
            </div>
            <div class="card-body">
                <message :alertmessage="msg" id="alertmsg"/>
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                        <label for="name" class="title">
                            Class
                            <strong>*</strong>
                        </label>
                        <select id="classid" @change="changeClass(ClassTimeTableObj.class_id)" class="inputbox" name="class" v-model="ClassTimeTableObj.class_id">                              
                            <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                        </select>
                        <span id="classmsg" class="error_message">Class is required</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                    <label for="name" class="title">
                        Section
                        <strong>*</strong>
                    </label>
                    <select id="sectionid" @change="changeSection(ClassTimeTableObj.section_id)" class="inputbox" name="class" v-model="ClassTimeTableObj.section_id">
                        <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                    </select>
                    <span id="sectionmsg" class="error_message">Section is required</span>
                </div>
                <div class="col-12">            
                    <button @click="goSearch()" class="searchButton" id="globalSearch">Search</button>
                </div>
            </div>
        </div>
        </div>

        <div v-if="showRecord" class="card">
            <div class="card-header">
                <h6>Class Timetable</h6>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table class="table table-hover" id="studenttable">
                        <thead>
                            <tr>
                                <th class="all" nowrap>Subject</th>
                                <th class="all" nowrap>Monday</th>
                                <th class="all" nowrap>Tuesday</th>
                                <th class="all" nowrap>Wednesday</th>
                                <th class="all" nowrap>Thursday</th>
                                <th class="all" nowrap>Friday</th>
                                <th class="all" nowrap>Saturday</th>
                                <th class="all" nowrap>Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ClassTimeTblList" :key="item.subjectname" class="active">
                                <td class="all" nowrap>{{ item.subjectname }}</td>
                                <td  v-for="timetbl in item.timetbllist" :key="timetbl.id" class="all" nowrap>
                                    <label style="display: block; margin: 0px;">{{ getTime(timetbl.time_from, timetbl.time_to) }}</label>
                                    <label style="display: block; margin: 0px;">{{ getRoomNo(timetbl.time_from, timetbl.time_to, timetbl.room_no) }}</label>
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
import { EventBus } from "../../js/event-bus.js";
import store from "store2";
import { Util } from '../../js/util';

export default {
    components: {        
        message
    },
    data() {
        return {
            ClassTimeTableObj: { "class_id": "", "section_id": ""},
            ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}],
            SectionList: [{"id":0,"section":"Class Section"}],

            ClassTimeTblList: [],
            msg: {
                text: "",
                type: ""
            },
            showRecord: false,
        }
    },
    created() {
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.ClassList = [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}];
            this.SectionList = [{"id":0,"section":"Class Section"}];
            this.getAllClass();
        });

        var message = store.get("msg");        
        if(message != null){                         
            this.msg.text = message;
            this.msg.type = "success";
            Util.workAlert('#alertmsg');
        }
        store.clearAll();

        this.getAllClass();
    },
    methods: {
        getAllClass() {
            this.axios.get("/api/class").then(response => {        
                this.sortClassSectionList(response.data);        
            });
        },

        sortClassSectionList(aList){       
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
            this.ClassTimeTableObj.class_id = this.ClassList[0].id;
            this.ClassTimeTableObj.section_id = this.SectionList[0].id;
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
            this.ClassTimeTableObj.section_id = this.SectionList[0].id;
            if(this.ClassTimeTableObj.class_id == 0)
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
            if(this.ClassTimeTableObj.class_id == "" || this.ClassTimeTableObj.class_id == undefined || this.ClassTimeTableObj.class_id == 0)
            {
                $('#classmsg').css('display', 'block');
                $('#classid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.ClassTimeTableObj.section_id == "" || this.ClassTimeTableObj.section_id == undefined || this.ClassTimeTableObj.section_id == 0)
            {
                $('#sectionmsg').css('display', 'block');
                $('#sectionid').css('border', '1px solid red');
                returnValue = false;
            }
            return returnValue;
        },

        goSearch(){            
            if(this.checkValidate())
            {
                this.axios.post('api/ClassTimeTable/viewsearch', this.ClassTimeTableObj).then(response => {                    
                    let array = response.data.sort((a, b) => {
                        if (a.classTimeTblid > b.classTimeTblid) {
                        return 1;
                        }
                        if (a.classTimeTblid < b.classTimeTblid) {
                        return -1;
                        }
                        return 0;
                    });
                    this.sortClassTimeTblList(array);
                    this.showRecord = true;
                });
            }
        },

        getTime(timefrom, timeto){
            if(timefrom == "" || timeto == "" || timefrom == null || timeto == null)  return "Not";
            else        return timefrom +"-"+ timeto;
        },

        getRoomNo(timefrom, timeto, roomno){
            if(timefrom == "" || timeto == "" || roomno == "" || timefrom == null || timeto == null || roomno == null)  return "Scheduled";
            else if(roomno == "" || roomno == null)     return "Room Number :";
            else        return "Room Number :"+ roomno;
        },

        sortClassTimeTblList(aList){
            this.ClassTimeTblList = [];
            for(let i=0; i < aList.length; i++){
                if(this.ClassTimeTblList == [] || this.ClassTimeTblList.length == 0)
                {
                    let timelist = [];
                    timelist.push({"id": aList[i].classTimeTblid, "day": aList[i].day, "time_from": aList[i].time_from, "time_to": aList[i].time_to, "room_no": aList[i].room_no});
                    this.ClassTimeTblList.push({"subjectname": aList[i].name, "timetbllist": timelist});
                }
                else
                {
                    let check = 0;
                    for(let a=0; a < this.ClassTimeTblList.length; a++){
                        if(this.ClassTimeTblList[a].subjectname == aList[i].name){
                            this.ClassTimeTblList[a].timetbllist.push({"id": aList[i].classTimeTblid, "day": aList[i].day, "time_from": aList[i].time_from, "time_to": aList[i].time_to, "room_no": aList[i].room_no});
                            check = 1;                            
                        }                        
                    }

                    if(check == 0){
                        let timelist1 = [];
                        timelist1.push({"id": aList[i].classTimeTblid, "day": aList[i].day, "time_from": aList[i].time_from, "time_to": aList[i].time_to, "room_no": aList[i].room_no});
                        this.ClassTimeTblList.push({"subjectname": aList[i].name, "timetbllist": timelist1});
                    }
                }
            }            
            console.log("Sort List >>>"+ JSON.stringify(this.ClassTimeTblList));
        }
    },
}
</script>