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
                                <div class="row">
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
                            <label for="uploadDate">Evaluation Date</label>
                            <input type="date" class="inputbox" id="uploadDate">
                        </div> 
                        <div class="col-lg-1">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg" style="padding: 0;">
                            <button class="save" id="globalSave" style="margin-top: 10px;">Save</button>
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
                                <span style="font-weight: bold">Homework Date:</span> 07/16/2018
                            </p>
                        </div>
                        <div style="padding: 5px 0px;">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar"  style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Submission Date:</span> 07/16/2018
                            </p>
                        </div>
                        <div style="padding: 5px 0px;">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar"  style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Evaluation Date:</span> 07/16/2018
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
                            <span style="font-weight: bold">Section:</span> A
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Class:</span> Class 1
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Subject:</span> Mathematics
                        </p>
                    </div>
                    <div style="padding: 5px 0px;">
                        <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                            <span style="font-weight: bold">Description:</span> Study table from 1-10 .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            checkCompleted: false,
            checkUnCompleted: false,
            selectStudents: [],
            selectCompletedStudents: [],
            showStudents: [
                {"id": 1,"name": "Name1","active": false},
                {"id": 2,"name": "Name2","active": false},
                {"id": 3,"name": "Name3","active": false},
                {"id": 4,"name": "Name4","active": false},
                {"id": 5,"name": "Name5","active": false},
                {"id": 6,"name": "Name6","active": false},
                {"id": 7,"name": "Name7","active": false},
                {"id": 8,"name": "Name8","active": false},
                {"id": 9,"name": "Name9","active": false},
                {"id": 10,"name": "Name10","active": false}
            ],
            showCompletedStudents : [],
        };
    },
    methods: {
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
        }
    }
};
</script>