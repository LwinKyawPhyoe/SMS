<template>
    <div>
        <div class="form" id="bar">
            <div class="toplink">
                <h2 class="stuName">
                    Homework
                </h2>
                <h4 class="stuLink">
                    <a href="" style="text-decoration:none;color:#1b5e20;">Home </a> > Homework
                </h4>
            </div>
            <hr style="margin-bottom: -0.5rem;">

            <confirm :url="props"></confirm>

            <div class="card">
                <div class="card-header">
                    <h6>Select Criteria</h6>
                </div>
                <div class="card-body">
                    <div class="row" id="row" style="margin: 0px;">
                        <div class="col-lg-4 col-12 textbox">
                            <label for="name" class="title">Class
                                <strong>*</strong>
                            </label>
                            <select id="class_id" class="inputbox" @change="selectClass(objData.class,'class_id','class_msg')" name="class" v-model="objData.class">
                                <option disabled value="">Select Class</option>
                                <option v-for="item in ClassList" :value="item.id">{{item.class}}</option>
                            </select>
                            <span id="class_msg" class="error_message">Class is required</span>
                        </div>
                        <div class="col-lg-4 col-12 textbox">
                            <label for="name" class="title">Section
                                <strong>*</strong>
                            </label>
                            <select id="section_id" class="inputbox" @change="selectSection(objData.section,'section_id','section_msg')" name="class" v-model="objData.section">
                                <option disabled value="">Select Section</option>
                                <option v-for="item in SectionList" :value="item.id">{{item.section}}</option>
                            </select>
                            <span id="section_msg" class="error_message">Section is required</span>
                        </div>
                        <div class="col-lg-4 col-12 textbox">
                            <label for="name" class="title">Subject
                            </label>
                            <select id="subject_id" class="inputbox" name="class" v-model="objData.subject">
                                <option disabled value="">Select Subject</option>
                                <option v-for="item in SubjectList" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="searchButton" id="globalSearch" @click="SearchData()">Search</button>
                        </div>
                    </div>
                </div>

                <div class="sub-header">
                    <h6>Homework List</h6>
                    <button class="add" data-toggle="modal" data-target="#AddHomework" @click="openAddHomework()">Add</button>
                </div>
                <div class="card-body">
                    <message :alertmessage="msg" id="alertmsg"/>
                    <input type="text" placeholder="Search..." class="searchText">
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
                                <a title="Columns" onclick="showColumns('columns','backgroundColumn')">
                                    <i class="fa fa-columns"></i>
                                </a>
                                
                                <div id="columns" class="columns">
                                    <div v-for="item in arrayTableColumns">
                                        <p @click="clickHideColumn(item)" :id="item.Id" class="tableLink">
                                            <span>{{item.Name}}</span>
                                        </p> 
                                    </div>
                                    <div>
                                        <p @click="clickShowColumn(arrayTableColumns)" class="tableLinkActive">
                                            <span>Restore visibility</span>
                                        </p>
                                    </div>
                                </div>
                                <div onclick="clickBackground('columns','backgroundColumn')" id="backgroundColumn" style="top: 0;left: 0;width: 100%;height: 100%;background: transparent;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">            
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th :class="arrayTableColumns[0].class" nowrap>Class</th>
                                    <th :class="arrayTableColumns[1].class" nowrap>Section</th>
                                    <th :class="arrayTableColumns[2].class" nowrap>Subject</th>
                                    <th :class="arrayTableColumns[3].class" nowrap>Homework Date</th>
                                    <th :class="arrayTableColumns[4].class" nowrap>Submission Date</th>
                                    <th :class="arrayTableColumns[5].class" nowrap>Evaluation Date</th>
                                    <th :class="arrayTableColumns[6].class" nowrap>Created By</th>
                                    <th :class="arrayTableColumns[7].class" style="text-align:right;" nowrap>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active" v-for="data in homeworkList">
                                    <td :class="arrayTableColumns[0].class" nowrap>
                                       {{ data.class }}
                                    </td>
                                    <td :class="arrayTableColumns[1].class" nowrap>
                                        {{ data.section }}
                                    </td>
                                    <td :class="arrayTableColumns[2].class" nowrap>
                                        {{ data.subject }}
                                    </td>
                                    <td :class="arrayTableColumns[3].class" nowrap>
                                        {{ showDate(data.homework_date) }}
                                    </td>
                                    <td :class="arrayTableColumns[4].class" nowrap>
                                        {{ showDate(data.submission_date) }}
                                    </td>
                                    <td :class="arrayTableColumns[5].class" nowrap>
                                        {{ showDate(returnDate(data)) }}
                                    </td>
                                    <td :class="arrayTableColumns[6].class" nowrap>

                                    </td>
                                    <td :class="arrayTableColumns[7].class" style="text-align:right;min-width: 80px">
                                        <i class="fa fa-list pen"  data-toggle="modal" data-target="#EvaluateHomework" @click="openDetailHomework(data)">
                                            <span class="penLabel">Detail</span>
                                        </i>
                                        <i class="fa fa-pencil pen" data-toggle="modal" data-target="#EditHomework" @click="openEditHomework(data)">
                                            <span class="penLabel">Edit</span>
                                        </i>
                                        <i class="fa fa-trash time" @click="goDelete(data.homeworkId)" data-toggle="modal" data-target="#exampleModalCenter">
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
        <!-- Start Add Homework  -->
        <div class="modal" id="AddHomework">
            <addmodal />
        </div>
        <!-- End Add Homework  -->
        <!-- Start Add Homework  -->
            <div class="modal" id="EditHomework">
                <editmodal />
            </div>
        <!-- End Add Homework  -->
        <!-- Start Evaluate Homework  -->
        <div class="modal" id="EvaluateHomework">
            <detailmodal />
        </div>
        <!-- End Evaluate Homework  -->
    </div>
</template>

<script>
import addmodal from "../Homework/add_homework_modal.vue";
import editmodal from "../Homework/edit_homework_modal.vue";
import detailmodal from "../Homework/detail_homework_modal.vue";
import { EventBus } from "../../js/event-bus.js";
import {Util} from '../../js/util';
import confirm from "../message/confirm.vue";
import message from "../Alertmessage/message.vue";
export default {
    components: {
        addmodal,
        editmodal,
        detailmodal,
        confirm,
        message,
    },
    data() {
        return {
            arrayTableColumns: [
                {"Name": "Class","Id": "ClassId", "class": "tbl_body_Class"},
                {"Name": "Section","Id": "SectionId", "class": "tbl_body_Section"},
                {"Name": "Subject","Id": "SubjectId", "class": "tbl_body_Subject"},
                {"Name": "Homework Date","Id": "HomeworkDateId", "class": "tbl_body_Homework"},
                {"Name": "Submission Date","Id": "SubmissionDateId", "class": "tbl_body_Submission"},
                {"Name": "Evaluation Date","Id": "Evaluation DateId", "class": "tbl_body_Evaluation"},
                {"Name": "Created By","Id": "CreatedById", "class": "tbl_body_Created"},
                {"Name": "Action","Id": "ActionId", "class": "tbl_body_Action"}
            ],
            props: {
                url: "",
                type: "",
            },
            msg: {
                text: "",
                type: ""
            },
            objData: {"class": "","section": "","subject": ""},
            homeworkList : [],
            evaluationDate: [],
            ClassList: [],
            SectionList: [],
            SubjectList: [],
        };
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("saveHomework", data => {
            this.msg.text = data.text;
            this.msg.type = data.type;
            Util.workAlert('#alertmsg');
            this.getHomeworkList();
        });
        EventBus.$on("clicked", response => {
            console.log(JSON.stringify(response));
            this.msg.text = response.text;
            this.msg.type = response.type;
            Util.workAlert('#alertmsg');
            this.getHomeworkList();
        });
        this.getHomeworkList();
        this.getAllClass();
    },
    methods: {
        getHomeworkList(){
            this.axios.get('/api/homework').then(response => {
                this.homeworkList = response.data;
            });
            this.axios.get('/api/homework_evaluation').then(response => {
                this.evaluationDate = response.data;
            });
        },
        // Get Class and Section
        getAllClass(){
            this.axios.get('/api/class').then(response => {
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
        // Select For Change
        selectClass(value, inputId, megId){
            Util.onValidate(value, inputId, megId);
            this.SectionList = [];
            this.SubjectList = [];
            this.objData.section = "";
            this.objData.subject = "";
            for(let i = 0;i < this.ClassList.length;i++){
                if(this.ClassList[i].id == this.objData.class){
                    this.SectionList = this.ClassList[i].section;
                }
            }
        },
        selectSection(value, inputId, megId){
            Util.onValidate(value, inputId, megId);
            this.SubjectList = [];
            this.objData.subject = "";
            let data = {"class_id": this.objData.class,"section_id": this.objData.section};
            this.axios.post("/api/AssSubject/search",data)
            .then(response => {
                this.axios.get("/api/subject").then(result => {
                    for(let i = 0;i < result.data.length;i++){
                        for(let a = 0;a < response.data.length;a++){
                            if(response.data[a].subject_id == result.data[i].id){
                                this.SubjectList.push({
                                    id: result.data[a].id,
                                    name: result.data[a].name
                                });
                            }
                        }
                    }
                });
            });
        },
        // Search
        SearchData(){
            if(this.checkValidation()){
                let formData = new FormData();
                formData.append("class", this.objData.class);
                formData.append("section", this.objData.section);
                formData.append("subject", this.objData.subject);
                if(this.objData.subject == ""){
                    this.axios.post('/api/homework/searchHomework', formData)
                    .then(result => {
                        this.homeworkList = result.data;
                    });
                }else{
                    this.axios.post('/api/homework/searchHomeworkSub', formData)
                    .then(result => {
                        this.homeworkList = result.data;
                    });
                }
            }
        },
        checkValidation(){
            let checkValue = true;
            if(this.objData.class == ""){
                Util.onValidateMessage('class_id','class_msg');
                checkValue = false;
            }
            if(this.objData.section == ""){
                Util.onValidateMessage('section_id','section_msg');
                checkValue = false;
            }
            return checkValue;
        },
        //Delete
        goDelete(aID){
            alert("aaa");
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `homework/${funName}/${aID}`;
        },
        // Open Menu
        openAddHomework(){
            EventBus.$emit("openAddHomework", "open");
        },
        openEditHomework(data){
            EventBus.$emit("openEditHomework", data);
        },
        openDetailHomework(data){
            EventBus.$emit("openEDetailHomework", data);
        },
        // For vue Return
        returnDate(data){
            var value = "";
            for(let i = 0; i < this.evaluationDate.length;i++){
                if(this.evaluationDate[i].homework_id == data.homeworkId){
                    value = this.evaluationDate[i].date;
                }
            }
            return value;
        },
        showDate(date) {
            if(date){
                let day = date.substring(6, 8);
                let month = date.substring(4, 6);
                let year = date.substring(0, 4);
                return day + "/" + month + "/" + year;
            }
        },
        // Column Hide 
        clickHideColumn(data){
            showTableHeader(data);
        },
        clickShowColumn(data){
            clickShowAllColumn(data);
        },
    }
};
</script>

<style>
    .modal_close_btn {
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        background-color: transparent;
    }

    .btn_check_box {
        background-color: #eae6e6;
        color: #000;
        height: 28px;
        width: 28px;
        font-size: 13px;
        cursor: pointer;
        border-radius: 2px;
        border: 1px solid #a9a3a3;
    }

    .btn_check_box:hover {
        background-color: #ddd;
    }

    .div_remove_student{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .modal_close_btn:hover {
        background-color: transparent;
        color: white;
    }

    .div_noactive{
        padding: 10px 15px;
        border-bottom: 1px solid #a9a3a3;
    }

    .div_active{
        padding: 10px 15px;
        color: white;
        background-color: #1b5e20;
        border-bottom: 1px solid #a9a3a3;
    }

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }

    @media (min-width: 992px){
        .modal-lg, .modal-xl {
            max-width: 950px;
        }
    }
    @media (max-width: 991px) and (min-width: 0px){
        .btn_check_small{
            float: right;
        }

        .btn_check_small1{
            float: left;
        }
        
        .div_remove_student{
            width: 50% !important;
            display: unset;
        }
    }
    @media (max-width: 576px) and (min-width: 0px){
        .modal-content {
            width: auto !important;
        }
    }
</style>