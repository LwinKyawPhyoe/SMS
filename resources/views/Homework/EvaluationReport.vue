<template>
    <div>
        <div class="form" id="bar">
            <div class="toplink">
                <h2 class="stuName">
                    Homework
                </h2>
                <h4 class="stuLink">
                    <a href="" style="text-decoration:none;color:#1b5e20;">Home </a> > Evaluation Report
                </h4>
            </div>
            <hr style="margin-bottom: -0.5rem;">

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
                    <h6>Evaluation Report</h6>
                </div>
                <div class="card-body">
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
                        <table class="table table-hover table-striped" id="studenttable">
                            <thead>
                                <tr>
                                    <th :class="arrayTableColumns[0].class" nowrap>Subject</th>
                                    <th :class="arrayTableColumns[1].class" nowrap>Homework Date</th>
                                    <th :class="arrayTableColumns[2].class" nowrap>Submission Date</th>
                                    <th :class="arrayTableColumns[3].class" nowrap>Complete/Incomplete</th>
                                    <th :class="arrayTableColumns[4].class" nowrap>Complete%</th>
                                    <th :class="arrayTableColumns[5].class" style="text-align:right;" nowrap>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active" v-for="data in homeworkList">
                                    <td :class="arrayTableColumns[0].class" nowrap>
                                        {{data.subject}}
                                    </td>
                                    <td :class="arrayTableColumns[1].class" nowrap>
                                        {{showDate(data.homework_date)}}
                                    </td>
                                    <td :class="arrayTableColumns[2].class" nowrap>
                                        {{showDate(data.submission_date)}}
                                    </td>
                                    <td :class="arrayTableColumns[3].class" nowrap>
                                        {{returnRatio(data)}}
                                    </td>
                                    <td :class="arrayTableColumns[4].class" nowrap>
                                        {{returnPrecent(data)}}
                                    </td>
                                    <td style="text-align:right;" :class="arrayTableColumns[5].class">
                                        <i class="fa fa-list pen"  data-toggle="modal" data-target="#EvaluateHomework" @click="openEvaluation(data)">
                                            <span class="penLabel">Detail</span>
                                        </i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        <!-- Start Evaluate Homework  -->
        <div class="modal" id="EvaluateHomework">
            <detailmodal />
        </div>
        <!-- End Evaluate Homework  -->
    </div>
</template>
<script>
    import detailmodal from "../Homework/detail_evaluation_modal.vue";
    import { EventBus } from "../../js/event-bus.js";
    import {Util} from '../../js/util';
    export default {
        components: {
            detailmodal
        },
        data() {
            return {
                checkColumns: false,
                arrayTableColumns: [
                    {"Name": "Subject","Id": "SubjectId", "class": "tbl_body_Subject"},
                    {"Name": "Homework Date","Id": "HomeworkDateId", "class": "tbl_body_Homework"},
                    {"Name": "Submission Date","Id": "SubmissionDateId", "class": "tbl_body_Submission"},
                    {"Name": "Complete/Incomplete","Id": "CompleteIncompleteId", "class": "tbl_body_CompleteIncomplete"},
                    {"Name": "Complete%","Id": "CompleteId", "class": "tbl_body_Complete"},
                    {"Name": "Action","Id": "ActionId", "class": "tbl_body_Action"}
                ],
                objData: {"class": "","section": "","subject": ""},
                homeworkList: [],
                ClassList: [],
                SectionList: [],
                SubjectList: [],
            };
        },
        created() {
            EventBus.$emit("ThemeClicked");
            this.getHomeworkList();
            this.getAllClass();
        },
        methods: {
            getHomeworkList(){
                this.axios.get('/api/homework/show').then(response => {
                    this.homeworkList = response.data;
                    console.log(JSON.stringify(response.data));
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
                        this.axios.post('/api/homework_evaluation/searchEvaluation', formData)
                        .then(result => {
                            this.homeworkList = result.data;
                        });
                    }else{
                        this.axios.post('/api/homework_evaluation/searchEvaluationSub', formData)
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
            // Open Model
            openEvaluation(data){
                EventBus.$emit("openEvaluation", data);
            },
            clickHideColumn(data){
                showTableHeader(data);
            },
            clickShowColumn(data){
                clickShowAllColumn(data);
            },
            returnRatio(data){
                var array1 = [];
                var array2 = []; 
                if(data.com_admission_no != "" && data.com_admission_no != null){
                    array1 = data.com_admission_no.split(',');
                }
                if(data.incom_admission_no != "" && data.incom_admission_no !=null){
                    array2 = data.incom_admission_no.split(',');
                }
               return array1.length+"/"+array2.length;
            },
            returnPrecent(data){
                var array1 = [];
                var array2 = []; 
                if(data.com_admission_no != "" && data.com_admission_no != null){
                    array1 = data.com_admission_no.split(',');
                }
                if(data.incom_admission_no != "" && data.incom_admission_no !=null){
                    array2 = data.incom_admission_no.split(',');
                }
                var value = (array1.length/(array1.length+ array2.length)) * 100;
                return value+ "%";
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
    }
</script>   