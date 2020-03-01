<template>
<div class="modal-dialog modal-lg">
    <div class="modal-content modal-media-content">
        <div class="sub-header" style="padding: 0px 15px;margin: 0px;">
            <h6>Add Homework</h6>
            <i class="fa fa-times time modal_close_btn" data-dismiss="modal"></i>
        </div>
            <div class="modal-body" style="padding: 10px 0px;">
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-4 col-12">
                        <label for="name" class="title">Class
                            <strong>*</strong>
                        </label>
                        <select id="class_id" class="inputbox" @change="selectClass(objData.class,'class_id','class_msg')" name="class" v-model="objData.class">
                            <option disabled value="0">Select Class</option>
                            <option v-for="item in ClassList" :value="item.id">{{item.class}}</option>
                        </select>
                        <span id="class_msg" class="error_message">Class is required</span>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="name" class="title">Section
                            <strong>*</strong>
                        </label>
                        <select id="section_id" class="inputbox" @change="selectSection(objData.section,'section_id','section_msg')" name="class" v-model="objData.section">
                            <option disabled value="0">Select Section</option>
                            <option v-for="item in SectionList" :value="item.id">{{item.section}}</option>
                        </select>
                        <span id="section_msg" class="error_message">Section is required</span>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="name" class="title">Subject
                            <strong>*</strong>
                        </label>
                        <select id="subject_id" class="inputbox" @change="selectSubject(objData.subject,'subject_id','subject_msg')" name="class" v-model="objData.subject">
                            <option disabled value="0">Select Subject</option>
                            <option value="1">Subject 1</option>
                            <option value="2">Subject 2</option>
                            <option value="3">Subject 3</option>
                        </select>
                        <span id="subject_msg" class="error_message">Subject is required</span>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="HomeworkDate">Homework Date</label>
                        <input type="date" class="inputbox" id="HomeworkDate" v-model="objData.homework_date">
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="SubmissionDate">Submission Date</label>
                        <input type="date" class="inputbox" id="SubmissionDate" v-model="objData.submission_date">
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="faPhoto">Attach Document</label>
                        <input type="file" class="inputbox" id="faPhoto" ref="documentFile">
                    </div>
                    <div  class="col-sm-12 col-lg-12 col-12" style="margin-top: 10px">
                        <label for="name" class="title">Description
                            <strong>*</strong>
                        </label>
                        <Vueditor ref="editor1"></Vueditor>
                        <span id="description_msg" class="error_message">Description is required</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 10px 15px;"> 
                <button class="save btn-dark" style="margin: 0px;" @click="addHomework()">Save</button>
            </div>
    </div>
</div>
</template>
<script>
import { EventBus } from "../../js/event-bus.js";
export default {
    data() {
        return {
            objData: {
                "class": "0","section": "0","subject": "0","homework_date": new Date().toISOString().substr(0, 10),
                "submission_date": new Date().toISOString().substr(0, 10),"document": "","description":""
            },
            ClassList: [],
            SectionList: [],
        };
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("openAddHomework", data => {
            this.getAllClass();
            this.$refs.editor1.setContent("");
            this.$refs.documentFile.value = '';
            this.SectionList = [];
            this.ClassList = [];
            this.objData.class = "0";
            this.objData.section = "0";
            document.getElementById('description_msg').style.display = "none";
            document.getElementById('class_msg').style.display = "none";
            document.getElementById('class_id').style.border = 'solid 1px #d2d6de';
            document.getElementById('section_msg').style.display = "none";
            document.getElementById('section_id').style.border = 'solid 1px #d2d6de';
            document.getElementById('subject_msg').style.display = "none";
            document.getElementById('subject_id').style.border = 'solid 1px #d2d6de';
        });
    },
    methods: {
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

        // Save Home work
        addHomework(){
            let rOne = this.$refs.editor1.getContent();
            this.objData.description = rOne;
            this.objData.document = this.$refs.documentFile.files[0];
            if(this.checkValidation()){
                let formData = new FormData();
                formData.append("class", this.objData.class);
                formData.append("section", this.objData.section);
                formData.append("subject", this.objData.subject);
                formData.append("homework_date", this.formatDate(this.objData.homework_date));
                formData.append("submission_date", this.formatDate(this.objData.submission_date));
                formData.append("document", this.objData.document);
                formData.append("description", this.objData.description);
                const config = {
                    headers: { "content-type": "multipart/form-data" }
                };
                this.axios.post('/api/homework/save', formData,config)
                .then(response => {
                    $('#AddHomework').modal('hide');
                    EventBus.$emit("saveHomework", response.data);
                }).catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response));
                });
            }
        },
        // Select For Change
        selectClass(value, inputId, megId){
            this.onValidate(value, inputId, megId);
            this.SectionList = [];
            this.objData.section = "0";
            for(let i = 0;i < this.ClassList.length;i++){
                if(this.ClassList[i].id === this.objData.class){
                    this.SectionList = this.ClassList[i].section;
                }
            }
        },
        selectSection(value, inputId, megId){
            this.onValidate(value, inputId, megId);
        },
        selectSubject(value, inputId, megId){
            this.onValidate(value, inputId, megId);
        },
        // Validation
        onValidationMessage(inputId, megId) {
            document.getElementById(inputId).style.border = "solid 1px red";
            document.getElementById(megId).style.display = "block";
        },
        onValidate(value, inputId, megId)
        {
            if(value == 0) document.getElementById(inputId).style.border = 'solid 1px red';
            else 
            {
                document.getElementById(inputId).style.border = 'solid 1px #d2d6de';
                document.getElementById(megId).style.display = 'none';
            }
        },
        checkValidation(){
            let checkValue = true;
            if(this.objData.class == 0){
                this.onValidationMessage('class_id','class_msg');
                checkValue = false;
            }
            if(this.objData.section == 0){
                this.onValidationMessage('section_id','section_msg');
                checkValue = false;
            }
            if(this.objData.subject == 0){
                this.onValidationMessage('subject_id','subject_msg');
                checkValue = false;
            }
            if(this.objData.description == "" || this.objData.description == undefined){
                document.getElementById('description_msg').style.display = "block";
                checkValue = false;
            }
            return checkValue;
        },
        // Save Date Format
        formatDate(date){
            let year = date.substring(0, 4);
            let month = date.substring(5, 7);
            let day = date.substring(8, 10);
            return year + month + day;
        }
    } 
};
</script>