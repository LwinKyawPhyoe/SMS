<template>
<div class="modal-dialog modal-lg">
    <div class="modal-content modal-media-content">
            <div class="sub-header" style="padding: 0px 15px;margin: 0px;">
            <h6>Evaluate List</h6>
            <i class="fa fa-times time modal_close_btn" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding: 0px">
            <div class="row" id="row" style="margin: 0px;">
                <div class="col-lg-8 col-12" style="padding: 15px">
                    <div class="alert alert-primary">
                        Homework already evaluated, now you can update evaluation.
                    </div>

                    <div class="row" id="row" style="margin: 0px;align-items: center;">
                        <div class="col-lg col-12" style="padding: 0px;">
                            <div style="margin-bottom: 5px;">
                                <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                    <span style="font-weight: bold">Students List</span>
                                </p>
                            </div>
                            <div style="padding: 15px;height: 450px;background-color: #eae6e6;">
                                <div class="row" style="margin: 0px;margin-bottom: 10px">
                                <div class="col-10" style="padding: 0px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="border-radius: unset;">
                                                <i class="fa fa-search" style="font-size: 12px;"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control inputbox" placeholder="Search">
                                    </div>
                                </div>
                                <div class="col-2" style="padding: 0px;">
                                    <button @click="checkStudent()" class="btn_check_box" style="float: right;">
                                        <i v-if="!checkUnCompleted" class="fa fa-square-o"></i>
                                        <i v-if="checkUnCompleted" class="fa fa-check-square-o"></i>
                                    </button>
                                </div>
                            </div>
                                <div style="height: 382px;background-color: white;overflow-y: scroll;">
                                    <div v-for="(item, index) in showStudents">
                                        <div @click="clickStudent(index)" v-if="!item.active" class="div_noactive">
                                            {{item.name}}
                                        </div>
                                        <div @click="clickStudent(index)" v-if="item.active" class="div_active">
                                            {{item.name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12" style="text-align: center;padding: 5px 0px;">
                            <div style="text-align: center;">
                                <div class="row" style="margin: 0px">
                                    <div class="col-sm-6 col-md-6 col-lg-12 div_remove_student">
                                        <button @click="goUnCompleted()" class="btn_check_box btn_check_small">
                                            <i class="fa fa-angle-left" style="font-size: 19px;font-weight: bold;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-12 div_remove_student">
                                        <button @click="goCompleted()" class="btn_check_box btn_check_small1">
                                            <i class="fa fa-angle-right" style="font-size: 19px;font-weight: bold;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-12" style="padding: 0px;">
                            <div style="margin-bottom: 5px;">
                                <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                    <span style="font-weight: bold">Homework Completed</span>
                                </p>
                            </div>
                            <div style="padding: 15px;height: 450px;background-color: #eae6e6;">
                                <div class="row" style="margin: 0px;margin-bottom: 10px">
                                <div class="col-10" style="padding: 0px;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="border-radius: unset;">
                                                    <i class="fa fa-search" style="font-size: 12px;"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control inputbox" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-2" style="padding: 0px;">
                                        <button  @click="checkCompletedStudent()" class="btn_check_box" style="float: right;">
                                            <i v-if="!checkCompleted" class="fa fa-square-o"></i>
                                            <i v-if="checkCompleted" class="fa fa-check-square-o"></i>
                                        </button>
                                    </div>
                                </div>
                                <div style="height: 382px;background-color: white;overflow-y: scroll;">
                                    <div v-for="(item, index) in showCompletedStudents">
                                        <div @click="clickCompletedStudent(index)" v-if="!item.active" class="div_noactive">
                                            {{item.name}}
                                        </div>
                                        <div @click="clickCompletedStudent(index)" v-if="item.active" class="div_active">
                                            {{item.name}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 0px 15px;margin-top: 15px;align-items:flex-end;">
                        <div class="col-sm-12 col-md-12 col-lg" style="padding: 0;">
                            <label for="Evaluation">Evaluation Date</label>
                            <input type="date" class="inputbox" id="Evaluation" v-model="ObjData.dvaluation_date">
                        </div> 
                        <div class="col-lg-1">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg" style="padding: 0;">
                            <button :disabled="btnDissable" class="save btn-dark" id="globalSave" style="margin-top: 10px;" @click="goSave()">Save</button>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-4 col-12" style="background-color: #eae6e6;">
                    <h4 style="margin: 10px 0px">Summary</h4>
                    <hr style="padding: 0px;margin: 0px">            
                    <div style="padding: 5px 0px;">
                        <div style="padding: 5px 0px;margin-top: 5px;">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar" style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Homework Date:</span> {{showDate(passData.homework_date)}}
                            </p>
                        </div>
                        <div style="padding: 5px 0px;">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar"  style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Submission Date:</span> {{showDate(passData.submission_date)}}
                            </p>
                        </div>
                        <div style="padding: 5px 0px;" v-if="ObjData.showSummaryDate">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar"  style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Evaluation Date:</span> {{showDate(ObjData.showSummaryDate)}}
                            </p>
                        </div>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Created By:</span> Joe Black
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Evaluated By:</span> Joe Black
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Section:</span> {{passData.section}}
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Class:</span> {{passData.class}}
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Subject:</span> {{passData.class}}
                        </p>
                    </div>
                    <div v-if="passData.document" style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;color:blue;cursor: pointer;">
                            <span style="font-weight: bold">Download</span> 
                             <i class="fa fa-download download" style="color:blue;"></i>
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Description:</span> {{passData.description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { EventBus } from "../../js/event-bus.js";
export default {
    created() {
        EventBus.$on("openEDetailHomework", data => {
            this.passData = data;
            this.checkCompleted= false;
            this.checkUnCompleted= false;
            this.ObjData.showSummaryDate = "";
            this.showStudents = [];
            this.showCompletedStudents = [];
            this.checkForUpdate = false;
            this.getStudent();
        });
    },
    data() {
        return {
            passData: {},
            ObjData: {"dvaluation_date": new Date().toISOString().substr(0, 10),"showSummaryDate": "",
                        "id": ""},
            checkCompleted: false,
            checkUnCompleted: false,
            checkForUpdate: false,
            btnDissable: false,
            selectStudents: [],
            selectCompletedStudents: [],
            showStudents: [],
            showCompletedStudents : [],
        };
    },
    methods: {
        getStudent(){
            let data = new FormData();
            data.append("id", this.passData.class_section_id);
            this.axios.post('/api/homework/showStudent', data)
            .then(response => {
                if(response.data == []){
                    this.btnDissable = true;
                }else{
                    this.btnDissable = false;
                }
                let formData = new FormData();
                formData.append("id", this.passData.homeworkId);
                this.axios.post('/api/homework_evaluation/show', formData)
                .then(result => {
                    if(result.data.length == 0){
                        for(let i = 0;i < response.data.length;i++){
                            this.showStudents.push({"id": response.data[i].id,"name": response.data[i].name,"active": false});
                        }
                    }else{
                        this.checkForUpdate = true;
                        this.ObjData.id = result.data[0].id;
                        if(result.data[0].com_admission_no == "" 
                        || result.data[0].com_admission_no == null){
                            for(let i = 0;i < response.data.length;i++){
                                this.showStudents.push({"id": response.data[i].id,"name": response.data[i].name,"active": false});
                            }
                        }else{
                            this.ObjData.showSummaryDate = result.data[0].date;
                            var arrayData = [];
                            arrayData = result.data[0].com_admission_no.split(',');
                            for(let i = 0;i < response.data.length;i++){
                                var value = false;
                                for(let a = 0;a < arrayData.length;a++){
                                    if(arrayData[a] == response.data[i].id){
                                        value = true;
                                        this.showCompletedStudents.push({"id": response.data[i].id,"name": response.data[i].name,"active": false});
                                    }
                                }
                                if(!value){
                                    this.showStudents.push({"id": response.data[i].id,"name": response.data[i].name,"active": false});
                                }
                            }
                        }
                    }
                }).catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response));
                });
            }).catch(error => {            
                console.log("err->" + JSON.stringify(this.error.response));
            });
        },
        goSave(){
            var com_admission_no = "";
            var incom_admission_no = "";
            var array1 = [];
            var array2 = [];
            for(let i = 0;i < this.showStudents.length;i++){
                array1.push(this.showStudents[i].id);
            }
            for(let i = 0;i < this.showCompletedStudents.length;i++){
                array2.push(this.showCompletedStudents[i].id);
            }
            if(array1 != []){
               incom_admission_no = array1.toString(); 
            }
            if(array2 != []){
               com_admission_no = array2.toString(); 
            }
            let formData = new FormData();
            formData.append("homework_id", this.passData.homeworkId);
            formData.append("com_admission_no", com_admission_no);
            formData.append("incom_admission_no", incom_admission_no);
            formData.append("date", this.formatDate(this.ObjData.dvaluation_date));
            var url = "";
            if(this.checkForUpdate){
                url = '/api/homework_evaluation/update';
                formData.append("id", this.ObjData.id);
            }else{
                url = '/api/homework_evaluation/save';
            }
            this.axios.post(url, formData)
            .then(response => {
                $('#EvaluateHomework').modal('hide');
                EventBus.$emit("saveHomework", response.data);
            }).catch(error => {            
                console.log("err->" + JSON.stringify(this.error.response));
            });
        },
        clickStudent(index){
            this.showStudents[index].active = !this.showStudents[index].active;
            if(this.selectStudents.length === 0){
                this.selectStudents.push(this.showStudents[index]);
            }else{  
                var condition = "";
                for(let i = 0;i < this.selectStudents.length;i++){
                    if(this.selectStudents[i].id === this.showStudents[index].id){
                        this.selectStudents.splice(i,1);
                        condition = "b";
                        break;
                    }else{
                        condition = "a";
                    } 
                }
                if(condition == "a"){
                    this.selectStudents.push(this.showStudents[index]);
                }
            }
        },
        clickCompletedStudent(index){
            this.showCompletedStudents[index].active = !this.showCompletedStudents[index].active;
            if(this.selectCompletedStudents.length === 0){
                this.selectCompletedStudents.push(this.showCompletedStudents[index]);
            }else{  
                var condition = "";
                for(let i = 0;i < this.selectCompletedStudents.length;i++){
                    if(this.selectCompletedStudents[i].id === this.showCompletedStudents[index].id){
                        this.selectCompletedStudents.splice(i,1);
                        condition = "b";
                        break;
                    }else{
                        condition = "a";
                    } 
                }
                if(condition == "a"){
                    this.selectCompletedStudents.push(this.showCompletedStudents[index]);
                }
            }
        },
        checkStudent(){
            this.selectStudents = [];
            for(var i = 0;i < this.showStudents.length;i++){
                if(!this.checkUnCompleted){
                    this.showStudents[i].active = true;
                    this.selectStudents.push(this.showStudents[i]);
                }else{
                    this.showStudents[i].active = false;
                }
            }
            this.checkUnCompleted = !this.checkUnCompleted;
        },
        checkCompletedStudent(){
            this.selectCompletedStudents = [];
            for(var i = 0;i < this.showCompletedStudents.length;i++){
                if(!this.checkCompleted){
                    this.showCompletedStudents[i].active = true;
                    this.selectCompletedStudents.push(this.showCompletedStudents[i]);
                }else{
                    this.showCompletedStudents[i].active = false;
                }
            }
            this.checkCompleted = !this.checkCompleted;
        },
        goCompleted(){
            for(let i = 0;i < this.selectStudents.length;i++){
                for(let a = 0;a < this.showStudents.length;a++){
                    if(this.selectStudents[i].id === this.showStudents[a].id){
                        this.showStudents.splice(a,1);
                    }
                }
                this.showCompletedStudents.push(this.selectStudents[i]);
                this.selectCompletedStudents.push(this.selectStudents[i]);
            }
            this.showCompletedStudents.sort((a, b) => {
                if (a.id > b.id) {
                    return 1;
                }
                if (a.id < b.id) {
                    return -1;
                }
                return 0;
            });
            this.selectStudents = [];
        },
        goUnCompleted(){
            for(let i = 0;i < this.selectCompletedStudents.length;i++){
                for(let a = 0;a < this.showCompletedStudents.length;a++){
                    if(this.selectCompletedStudents[i].id === this.showCompletedStudents[a].id){
                        this.showCompletedStudents.splice(a,1);
                    }
                }
                this.showStudents.push(this.selectCompletedStudents[i]);
                this.selectStudents.push(this.selectCompletedStudents[i]);
            }
            this.showStudents.sort((a, b) => {
                if (a.id > b.id) {
                    return 1;
                }
                if (a.id < b.id) {
                    return -1;
                }
                return 0;
            });
            this.selectCompletedStudents = [];
        },
        showDate(date) {
            if(date){
                let day = date.substring(6, 8);
                let month = date.substring(4, 6);
                let year = date.substring(0, 4);
                return day + "/" + month + "/" + year;
            }
        },
        formatDate(date){
            let year = date.substring(0, 4);
            let month = date.substring(5, 7);
            let day = date.substring(8, 10);
            return year + month + day;
        },
    }
};
</script>
