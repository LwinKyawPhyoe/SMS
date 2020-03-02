<template>
<div class="modal-dialog modal-lg">
    <div class="modal-content modal-media-content">
            <div class="sub-header" style="padding: 0px 15px;margin: 0px;">
            <h6>Homework Evaluation</h6>
            <i class="fa fa-times time modal_close_btn" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding: 0px">
            <div class="row" id="row" style="margin: 0px;">
                <div class="col-lg-8 col-12" style="padding: 0px">
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
                                <a title="Columns" onclick="showColumns('ModalColumns','ModalBackground')">
                                    <i class="fa fa-columns"></i>
                                </a>
                                
                                <div id="ModalColumns" class="columns">
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
                                <div onclick="clickBackground('ModalColumns','ModalBackground')" id="ModalBackground" style="top: 0;left: 0;width: 100%;height: 100%;background: transparent;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">            
                        <table class="table table-hover table-striped" id="studenttable">
                            <thead>
                                <tr>
                                    <th :class="arrayTableColumns[0].class" nowrap>Admission Number</th>
                                    <th :class="arrayTableColumns[1].class" nowrap>Name</th>
                                    <th :class="arrayTableColumns[2].class" nowrap style="float: right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active" v-for="data in studentList">
                                    <td :class="arrayTableColumns[0].class" nowrap>
                                        {{data.admission_no}}
                                    </td>
                                    <td :class="arrayTableColumns[1].class" nowrap>
                                        {{data.name}}
                                    </td>
                                    <td :class="arrayTableColumns[2].class" nowrap style="float: right;">
                                        <a v-if="data.active" href="#" style="text-decoration:none;" class="btn-success btn-sm">Complete</a>
                                        <a v-if="!data.active" href="#" style="text-decoration:none;" class="btn-danger btn-sm">Incomplete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="col-lg-4 col-12" style="background-color: #eae6e6;padding: 1rem;">
                    <h4 style="margin: 0px;margin-bottom: 10px">Summary</h4>
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
                        <div style="padding: 5px 0px;">
                            <p style="padding: 0px;margin: 0px !important;font-size: 14px;">
                                <i class="fa fa-calendar"  style="font-size: 15px;"></i>
                                &nbsp;
                                <span style="font-weight: bold">Evaluation Date:</span> {{showDate(passData.date)}}
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
                            <span style="font-weight: bold">Subject:</span> {{passData.subject}}
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
            EventBus.$on("openEvaluation", data => {
                this.passData = data;
                this.getStudent();
                this.clickShowColumn(this.arrayTableColumns);
            });
        },
        data() {
            return {
                checkColumns: false,
                arrayTableColumns: [
                    {"Name": "Admission Number","Id": "AdmissionNumberId", "class": "tbl_body_Admission"},
                    {"Name": "Name","Id": "NameId", "class": "tbl_body_Name"},
                    {"Name": "Status","Id": "StatusId", "class": "tbl_body_Status"}
                ],
                passData: {},
                studentList: [],
            };
        },
        methods: {
            getStudent(){
                let data = new FormData();
                this.studentList = [];
                data.append("id", this.passData.class_section_id);
                this.axios.post('/api/homework/showStudent', data)
                .then(response => {
                    var array1 = [];
                    var array2 = []; 
                    if(this.passData.com_admission_no != "" && this.passData.com_admission_no != null){
                        array1 = this.passData.com_admission_no.split(',');
                    }
                    if(this.passData.incom_admission_no != "" && this.passData.incom_admission_no !=null){
                        array2 = this.passData.incom_admission_no.split(',');
                    }
                    for(let i = 0;i < response.data.length;i++){
                        for(let a = 0;a < array1.length;a++){
                            if(array1[a] == response.data[i].id){
                                this.studentList.push({"admission_no": response.data[i].admission_no,"name": response.data[i].name,"active": true});
                            }
                        }
                        for(let b = 0;b < array2.length;b++){
                            if(array2[b] == response.data[i].id){
                                this.studentList.push({"admission_no": response.data[i].admission_no,"name": response.data[i].name,"active": false});
                            }
                        }
                    }
                    console.log(JSON.stringify(this.studentList));
                }).catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response));
                });
            },
            clickHideColumn(data){
                showTableHeader(data);
            },
            clickShowColumn(data){
                clickShowAllColumn(data);
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