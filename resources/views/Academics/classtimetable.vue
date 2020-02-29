<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Academics</h2>
            <h4 class="stuLink">
                <router-link to="home" class="home">Home</router-link> 
                > <router-link to="/viewtimetable" class="home">Class TimeTable</router-link> > Create Class TimeTable
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <div class="card">
            <div class="card-header">
                <h6>Select Criteria</h6>
            </div>
            <div class="card-body">
                <div class="row" id="row" style="margin: 0px;">
                <div class="col-lg-4 col-md-4 col-12 textbox">
                    <label for="name" class="title">
                        Class
                        <strong>*</strong>
                    </label>
                    <select id="classid" @change="changeClass(ClassTimeTableObj.class_id)" class="inputbox" name="class" v-model="ClassTimeTableObj.class_id">                              
                        <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                    </select>
                    <span id="classmsg" class="error_message">Class is required</span>
                </div>
                <div class="col-lg-4 col-md-4 col-12 textbox">
                    <label for="name" class="title">
                        Section
                        <strong>*</strong>
                    </label>
                    <select id="sectionid" @change="changeSection(ClassTimeTableObj.section_id)" class="inputbox" name="class" v-model="ClassTimeTableObj.section_id">
                        <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                    </select>
                    <span id="sectionmsg" class="error_message">Section is required</span>
                </div>
                <div class="col-lg-4 col-md-4 col-12 textbox">
                    <label for="name" class="title">
                        Subject
                        <strong>*</strong>
                    </label>
                    <select id="subjectid" @change="changeSubject(ClassTimeTableObj.subject_id)" class="inputbox" name="class" v-model="ClassTimeTableObj.subject_id">
                        <option v-for="sublist in SubjectList" :key="sublist.id" :value="sublist.id">{{getSubjectName(sublist.name,sublist.type)}}</option>
                    </select>
                    <span id="subjectmsg" class="error_message">Subject is required</span>
                </div>
                <div class="col-12">                    
                    <button @click="goSearch()" class="searchButton" id="globalSearch">Search</button>
                </div>
                </div>
            </div>

            <div v-if="showTimeTbl" class="sub-header">
                <h6>Class Timetable</h6>
            </div>
            <div v-if="showTimeTbl" class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-striped" id="studenttable">
                    <thead>
                        <tr>
                            <th class="all" nowrap style="padding-left: 10px;">Day</th>
                            <th class="all" nowrap style="padding-left: 25px;">Start Time</th>
                            <th class="all" nowrap style="padding-left: 25px;">End Time</th>
                            <th class="all" nowrap style="padding-left: 25px;">Room Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="obj in classTimeTbl" :key="obj.id">
                            <td class="all" nowrap>{{ obj.day }}</td>
                            <td class="all" nowrap>
                                <div class="col-md-12">                                    
                                    <!-- <input type="text" class="inputbox timepicker" value="14:00"> -->
                                    <input type="text" class="inputbox" name="time_from" v-model="obj.time_from"/>
                                </div>
                            </td>
                            <td class="all" nowrap>                                
                                <div class="col-md-12">                                    
                                    <input type="text" class="inputbox" name="time_to" v-model="obj.time_to"/>
                                </div>
                            </td>
                            <td class="all" nowrap>
                                <div class="col-md-12">
                                    <input type="text" class="inputbox" name="room_no" v-model="obj.room_no"/>
                                </div>
                            </td>
                        </tr>                                                
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <button class="save" @click="goSave()" id="globalSave" style="margin:-1rem 0 1rem;">Save</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
import { EventBus } from "../../js/event-bus.js";
import store from "store2";
export default {
    components: {
        VueCtkDateTimePicker
    },
    data() {
        return {
            ClassTimeTableObj: { "class_id": "", "section_id": "", "subject_id": "", "staff_id": "", "classtimetbl": []},
            ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}],
            SectionList: [{"id":0,"section":"Class Section"}],
            SubjectList: [{"id":0, "name":"Select Subject", "type": "", "staff_id": ""}],
            AllSubjectList: [],
            showTimeTbl: false,

            classTimeTbl: [
                {"id": "", "day": "Monday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Tuesday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Wednesday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Thursday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Friday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Saturday", "time_from": "", "time_to": "", "room_no": ""},
                {"id": "", "day": "Sunday", "time_from": "", "time_to": "", "room_no": ""}
            ]
        }
    },
    created() {
        EventBus.$on("SessionSaved", response => {
            this.ClassTimeTableObj = { "class_id": "", "section_id": "", "subject_id": "", "staff_id": "", "classtimetbl": []};
            this.ClassList = [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}];
            this.SectionList = [{"id":0,"section":"Class Section"}];
            this.SubjectList = [{"id":0, "name":"Select Subject", "type": "", "staff_id": ""}];
            this.AllSubjectList = [];
            console.log(JSON.stringify(response));
            this.getAllSubject();
            this.getAllClass();            
        });
        this.getAllSubject();
        this.getAllClass();        
    },
    methods: {
        getAllSubject(){
            this.axios
                .get('/api/subject')
                .then(response => {                    
                    for(let i=0; i<response.data.length; i++){
                        this.AllSubjectList.push({"id": response.data[i].id, "name": response.data[i].name, "type": response.data[i].type, "staff_id": response.data[i].staff_id});
                    }
                    this.ClassTimeTableObj.subject_id = this.SubjectList[0].id;                    
                });
        },

        getAllClass() {
            this.axios.get("/api/class").then(response => {        
                this.sortList(response.data);        
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

        getSubjectName(aName, aType){
            if(aType == "")   return aName;
            else    return aName+" "+"("+aType+")";
        },

        changeSection(aId)
        {            
            this.SubjectList = [{"id":0, "name":"Select Subject", "type": "", "staff_id": 0}];
            this.axios.post('/api/AssSubject/search', this.ClassTimeTableObj).then(response => {            
                for(let i=0; i<response.data.length; i++){                    
                    for(let s=0; s<this.AllSubjectList.length; s++){
                        if(response.data[i].subject_id == this.AllSubjectList[s].id){
                            this.SubjectList.push({"id": this.AllSubjectList[s].id, "name": this.AllSubjectList[s].name, "type": this.AllSubjectList[s].type, "staff_id": response.data[i].staff_id});
                        }
                    }
                }
            });            
            this.ClassTimeTableObj.subject_id = this.SubjectList[0].id;
            if(aId == 0)   $('#sectionid').css('border', '1px solid red');
            else
            {
                $('#sectionmsg').css('display', 'none');        
                $('#sectionid').css('border', '1px solid #d2d6de');
            }
        },

        changeSubject(aId){
            for(let i=0; i<this.SubjectList.length; i++){
                if(this.SubjectList[i].id == aId){
                    this.ClassTimeTableObj.staff_id = this.SubjectList[i].staff_id;                    
                    break;
                }
            }            
            if(aId == 0)   $('#subjectid').css('border', '1px solid red');
            else
            {
                $('#subjectmsg').css('display', 'none');        
                $('#subjectid').css('border', '1px solid #d2d6de');
            }
            this.showTimeTbl = false;
            this.classTimeTbl = [];
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
            if(this.ClassTimeTableObj.subject_id == "" || this.ClassTimeTableObj.subject_id == undefined || this.ClassTimeTableObj.subject_id == 0)
            {
                $('#subjectmsg').css('display', 'block');
                $('#subjectid').css('border', '1px solid red');
                returnValue = false;
            }
            return returnValue;
        },

        goSearch(){            
            if(this.checkValidate())
            {
                this.axios.post('api/ClassTimeTable/search', this.ClassTimeTableObj).then(response => {                    
                    this.showTimeTbl = true;                    
                    this.classTimeTbl = [
                        {"id": "", "day": "Monday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Tuesday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Wednesday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Thursday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Friday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Saturday", "time_from": "", "time_to": "", "room_no": ""},
                        {"id": "", "day": "Sunday", "time_from": "", "time_to": "", "room_no": ""}
                    ];
                    for(let i=0; i<response.data.length; i++){                        
                        for(let a=0; a<this.classTimeTbl.length; a++){
                            if(this.classTimeTbl[a].day == response.data[i].day){
                                this.classTimeTbl[a] = {"id": response.data[i].id, "day": response.data[i].day, "time_from": response.data[i].time_from, "time_to": response.data[i].time_to, "room_no": response.data[i].room_no};
                            }
                        }
                    }                    
                });
            }
        },

        goSave(){
            this.ClassTimeTableObj.classtimetbl = this.classTimeTbl;            
            this.axios.post('/api/ClassTimeTable/save', this.ClassTimeTableObj).then(response =>{                
                this.$router.push({name: 'viewtimetable'});
                store.set("msg",response.data.text);
            });
        }
    },
}
</script>