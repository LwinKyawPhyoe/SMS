<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Academics</h2>
            <h4 class="stuLink">
                <router-link to="/dashboard" class="home">Home</router-link>> Assign Class Teacher
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <confirm :url="props"></confirm>
        <Loading></Loading>
        <div class="row rowContainer" style="align-items: end !important;">
            <div class="col-lg-5 col-md-12" style="padding:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Assign Class Teacher</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-lg-12 col-md-6 col-12">
                                <label for="name" class="title">
                                    Class
                                    <strong>*</strong>
                                </label>
                                <select id="classid" @change="changeClass(ClassTeacher.class_id)" class="inputbox" name="class" v-model="ClassTeacher.class_id">                              
                                    <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                                </select>
                                <span id="classmsg" class="error_message">Class is required</span>
                            </div>
                            <div class="col-lg-12 col-md-6 col-12">
                                <label for="name" class="title">
                                    Section
                                    <strong>*</strong>
                                </label>
                                <select id="sectionid" @change="changeSection(ClassTeacher.section_id)" class="inputbox" name="class" v-model="ClassTeacher.section_id">
                                    <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                                </select>
                                <span id="sectionmsg" class="error_message">Section is required</span>
                            </div>
                            <div class="col-12">
                                <label for="class">
                                    Class Teacher
                                    <strong>*</strong>
                                </label>              
                                <div v-for="teacher in TeacherList" :key="teacher.id" class="checkbox">
                                    <label class="checkboxlabel">
                                        <input type="checkbox" class="checkboxinput" value="" v-model="teacher.checked" @click="click_checkbox($event, teacher)"/> {{ teacher.name }}                  
                                    </label>
                                </div>
                                <span id="classteachermsg" class="error_message">Class Teacher is required</span>
                            </div>
                            <div class="col-12 column-12">
                                <button type="submit" id="globalSave" class="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12" style="padding-left:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Class Teacher List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg" id="delalertmsg"/>
                        <input v-on:keyup="searchTable()" id="myInput" type="text" placeholder="Search..." class="searchText"/>
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                    <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Assign_Class_Teacher.xls')" title="Excel">
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
                        <div v-if="AssClassTeacherList.length == 0">
                            <h1 class="NoData">No Data</h1>
                        </div>
                        <div v-if="AssClassTeacherList.length != 0" class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable">
                                <thead>
                                    <tr>
                                        <th class="all" nowrap>Class</th>
                                        <th class="all" nowrap>Sections</th>
                                        <th class="all" nowrap>Class Teacher</th>
                                        <th class="all" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr v-for="obj in AssClassTeacherList" :key="obj.id" class="active">
                                        <td class="all" nowrap>{{getClassname(obj.class_id)}}</td>
                                        <td class="all" nowrap>{{getSectionName(obj.section_id)}}</td>
                                        <td class="all" nowrap>                      
                                            <label v-for="staff in obj.staff_id" :key="staff" style="display: block; margin: 0px;font-size: 13px;font-weight: 200;">{{getStaffName(staff)}}</label>
                                        </td>
                                        <td style="text-align:right;">
                                            <i @click="goEdit(obj)" class="fa fa-pencil pen">
                                                <span class="penLabel">Edit</span>
                                            </i>
                                            <i @click="goDelete(obj.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
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
import Loading from "../LoadingController.vue";

import { EventBus } from "../../js/event-bus.js";
import {Util} from '../../js/util';

export default {
    components: {
        Loading,
        confirm,
        message    
    },
    data() {
        return {
            ClassTeacher: {"id": "", "class_id": "", "section_id": "", "Teacher": ""},
            Teacher: [],
            ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Select Section"}]}],
            SectionList: [{"id":0,"section":"Select Section"}],
            TeacherList: [],
            AssClassTeacherList: [],
            classsection:[],
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
            }
        }
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {            
            this.deletemsg.text = response.text;
            this.deletemsg.type = response.type;
            Util.workAlert('#delalertmsg');
            this.getAssClassTeacher();
        });
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.ClassList = [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Select Section"}]}];
            this.SectionList = [{"id":0,"section":"Select Section"}];
            this.getAllClass();
            this.getAllSection();    
        });
        this.getAllClass();
        this.getAllSection();
        this.getAssClassTeacher();
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
                        this.TeacherList.push({"id": response.data[i].id, "name": response.data[i].designation_name, "checked": false});
                    }
                    console.log(JSON.stringify(this.TeacherList));
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

        getAllSection(){
            this.axios
                .get('/api/section')
                .then(response => {            
                    this.classsection = response.data;
                });
        },

        getClassname(aClassid){      
            for(let i=0; i < this.ClassList.length; i++){
                if(aClassid == this.ClassList[i].id){          
                    return this.ClassList[i].class;
                    break;
                }
            }
        },

        getSectionName(aSectionid){
            for(let i=0; i < this.classsection.length; i++){
                if(aSectionid == this.classsection[i].id){
                    return this.classsection[i].section;
                    break;
                }
            }
        },

        getStaffName(aStaffid){
            for(let i=0; i < this.TeacherList.length; i++){
                if(aStaffid == this.TeacherList[i].id){
                    return this.TeacherList[i].name;
                    break;
                }
            }
        },

        getAssClassTeacher(){
            EventBus.$emit("onLoad");
            this.AssClassTeacherList = [];            
            this.axios.get("/api/classTeacher").then(response => {                          
                for(let i=0; i < response.data.length; i++){
                    let staffAry = [];
                    staffAry = response.data[i].staff_id.split(",");
                    this.AssClassTeacherList.push({"id": response.data[i].id, "class_id": response.data[i].class_id, "staff_id": staffAry, "section_id": response.data[i].section_id});                    
                    EventBus.$emit("onLoadEnd");
                }          
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
            this.ClassTeacher.class_id = this.ClassList[0].id;
            this.ClassTeacher.section_id = this.SectionList[0].id;
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
            this.ClassTeacher.section_id = this.SectionList[0].id;
            if(this.ClassTeacher.class_id == 0)
            {
                $('#classid').css('border', '1px solid red');
            }
            else
            {
                $('#classmsg').css('display', 'none');
                $('#classid').css('border', '1px solid #d2d6de');
            }
        },

        changeSection(aId){
            if(aId == 0)   $('#sectionid').css('border', '1px solid red');
            else
            {
                $('#sectionmsg').css('display', 'none');        
                $('#sectionid').css('border', '1px solid #d2d6de');
            }
        },

        click_checkbox(e, aObj){
            if(e.target.checked)
            {
                this.Teacher.push(aObj.id);
                $('#classteachermsg').css('display', 'none');
            }
            else
            {
                this.Teacher.splice(this.Teacher.map(item => item).indexOf(aObj.id), 1);
                if(this.Teacher == []|| this.Teacher.length == 0 || this.Teacher == undefined)
                {          
                    $('#classteachermsg').css('display', 'block')
                }
            }
        },

        checkValidate()
        {
            var returnValue = true;
            if(this.ClassTeacher.class_id == "" || this.ClassTeacher.class_id == undefined || this.ClassTeacher.class_id == 0)
            {
                $('#classmsg').css('display', 'block');
                $('#classid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.ClassTeacher.section_id == "" || this.ClassTeacher.section_id == undefined || this.ClassTeacher.section_id == 0)
            {
                $('#sectionmsg').css('display', 'block');
                $('#sectionid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.Teacher == []|| this.Teacher.length == 0 || this.Teacher == undefined)
            {          
                $('#classteachermsg').css('display', 'block');
                returnValue = false;
            }
            return returnValue;
        },

        goSave()
        {
            if(this.checkValidate())
            {
                this.ClassTeacher.Teacher = this.Teacher.toString();                
                this.axios
                    .post('/api/ClassTeacher/save', this.ClassTeacher)
                    .then(response => {                        
                        this.getAssClassTeacher();
                        this.Teacher = [];
                        this.ClassTeacher = {"class_id": "", "section_id": "", "Teacher": ""};
                        this.msg.text = response.data.text;
                        this.msg.type = response.data.type;
                        Util.workAlert('#alertmsg');
                        for(let i=0; i<this.TeacherList.length; i++){
                            this.TeacherList[i].checked = false;
                        }
                    })
                    .catch(error => {            
                        console.log("err->" + JSON.stringify(this.error.response));
                    });
            }
        },

        goEdit(aObj)
        {
            this.TeacherList = [{"id": 1, "name": "Shivam", "checked": false},{"id": 2, "name": "Jason", "checked": false}];
            for(let i=0; i<this.ClassList.length;i++){
                if(this.ClassList[i].id == aObj.class_id){
                    for(let a=0; a<this.ClassList[i].section.length; a++){
                        this.SectionList.push(this.ClassList[i].section[a]);
                    }
                    break;
                }
            }
            this.ClassTeacher.id = aObj.id;
            this.ClassTeacher.class_id = aObj.class_id;      
            this.ClassTeacher.section_id = aObj.section_id;      
            for(let a=0; a < aObj.staff_id.length; a++){
                for(let i = 0; i < this.TeacherList.length; i++){
                    if(this.TeacherList[i].id == Number(aObj.staff_id[a])){
                        this.Teacher.push(Number(aObj.staff_id[a]));
                        this.TeacherList.splice(i, 1, {"id": this.TeacherList[i].id, "name": this.TeacherList[i].name, "checked": true});
                    }
                }
            }      
        },

        goDelete(aID)
        {
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `ClassTeacher/${funName}/${aID}`;
        },

        searchTable() {
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
        },

        printme(table)
        {
            Util.printme(table);
        },

        downloadExcel(table, name, filename) 
        {
            Util.downloadExcel(table,name,filename);
        }
    }
}
</script>