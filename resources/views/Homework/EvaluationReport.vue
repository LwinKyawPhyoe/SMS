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
                            <select class="inputbox" name="class">
                                <option selected disabled>Select Class</option>
                                <option value="Class A">Class A</option>
                                <option value="Class B">Class B</option>
                                <option value="Class C">Class C</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-12 textbox">
                            <label for="name" class="title">Section
                                <strong>*</strong>
                            </label>
                            <select class="inputbox" name="class">
                                <option selected disabled>Select Section</option>
                                <option value="Section A">Section A</option>
                                <option value="Section B">Section B</option>
                                <option value="Section C">Section C</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-12 textbox">
                            <label for="name" class="title">Subject
                            </label>
                            <select class="inputbox" name="class">
                                <option selected disabled>Select Subject</option>
                                <option value="Subject 1">Subject 1</option>
                                <option value="Subject 2">Subject 2</option>
                                <option value="Subject 3">Subject 3</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="searchButton">Search</button>
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
                                <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Evaluation_Report.xls')" title="Excel">
                                    <i class="fa fa-file-excel-o"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="#" @click.prevent="printme('print')" title="Print">
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <a title="Columns" onclick="showColumns('columns','backgroundColumn')">
                                <i class="fa fa-columns"></i>
                                </a>
                                
                                <div id="columns" class="columns">
                                    <div v-for="item in arrayTableColumns" :key="item.Id">
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

                    <div class="table-responsive" id="print">            
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
                                <tr class="active">
                                    <td :class="arrayTableColumns[0].class" nowrap>
                                        Subject 1
                                    </td>
                                    <td :class="arrayTableColumns[1].class" nowrap>
                                        07/02/2018
                                    </td>
                                    <td :class="arrayTableColumns[2].class" nowrap>
                                        07/02/2018
                                    </td>
                                    <td :class="arrayTableColumns[3].class" nowrap>
                                        
                                    </td>
                                    <td :class="arrayTableColumns[4].class" nowrap>
                                        
                                    </td>
                                    <td style="text-align:right;" :class="arrayTableColumns[5].class">
                                        <i class="fa fa-list pen"  data-toggle="modal" data-target="#EvaluateHomework">
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
    import message from "../Alertmessage/message.vue";
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
            };
        },
        methods: {
            clickHideColumn(data){
                showTableHeader(data);
            },
            clickShowColumn(data){
                clickShowAllColumn(data);
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