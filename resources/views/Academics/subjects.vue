<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Academics</h2>
            <h4 class="stuLink">
                <router-link to="/dashboard" class="home">Home</router-link>> Subject
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <confirm :url="props"></confirm>
        <Loading></Loading>
        <div class="row rowContainer" style="align-items: end !important;">
            <div class="col-lg-5 col-md-12" style="padding:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Subject</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="subjectname">
                                    Subject Name
                                    <strong>*</strong>
                                </label>
                                <input id="subjectid" type="text" class="inputbox" name="subjectname" v-model="subjectObj.name"
                                    @keyup="onValidate(subjectObj.name, 'subjectid', 'subjectmsg')" 
                                    v-on:blur="onValidate(subjectObj.name, 'subjectid', 'subjectmsg')"/>
                                <span id="subjectmsg" class="error_message">Subject Name is required</span>
                            </div>
                            <div class="col-12">
                                <label class="radio-inline" style="display: inline-block;margin-bottom: .5rem;margin-top: 15px;padding-right: 20px;">
                                    <input type="radio" name="subjectType" checked value="theory" v-model="type"/> Theory
                                </label>
                                <label class="radio-inline" style="display: inline-block;margin-bottom: .5rem;margin-top: 15px;padding-right: 20px;">
                                    <input type="radio" name="subjectType" value="practical" v-model="type"/> Practical
                                </label>
                            </div>
                            <div class="col-12">
                                <label for="subjectcode">Subject Code</label>
                                <input type="text" class="inputbox" name="subjectcode" v-model="subjectObj.code"/>
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
                        <h6>Subject List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg" id="delalertmsg"/>
                        <input v-on:keyup="searchTable()" id="myInput" type="text" placeholder="Search..." class="searchText"/>
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Subject.xls')" title="Excel">
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
                        <div v-if="SubjectList.length == 0">
                            <h1 class="NoData">No Data</h1>
                        </div>
                        <div v-if="SubjectList.length != 0" class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable">
                                <thead>
                                    <tr>
                                        <th class="all" nowrap>Subject</th>
                                        <th class="all" nowrap>Subject Code</th>
                                        <th class="all" nowrap>Subject Type</th>
                                        <th class="all" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr v-for="sub in SubjectList" :key="sub.id" class="active">
                                        <td class="all" nowrap>{{ sub.name }}</td>
                                        <td class="all" nowrap>{{ sub.code }}</td>
                                        <td class="all" nowrap>{{ sub.type }}</td>
                                        <td style="text-align:right;">
                                            <i @click="goEdit(sub.id)" class="fa fa-pencil pen">
                                            <span class="penLabel">Edit</span>
                                            </i>
                                            <i @click="goDelete(sub.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
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
import message from '../Alertmessage/message.vue';
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
            subjectObj: {"name": "", "type": "", "code": ""},
            type: "theory",
            SubjectList: [],
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
            },
        }
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {            
            this.deletemsg.text = response.text;
            this.deletemsg.type = response.type;
            Util.workAlert('#delalertmsg');
            this.getAllSubject();
        });
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.getAllSubject();
        });
        this.getAllSubject();
    },
    mounted() {
        EventBus.$emit("onLoad");
    },
    methods: {
        getAllSubject(){
            EventBus.$emit("onLoad");
            this.axios
                .get('/api/subject')
                .then(response => {
                    this.SubjectList = response.data;
                    EventBus.$emit("onLoadEnd");
                });
        },

        onValidate(value, inputId, megId)
        {
            Util.onValidate(value, inputId, megId);
        },

        checkValidate()
        {
            var returnValue = true;
            if(this.subjectObj.name == "" || this.subjectObj.name == undefined)
            {
                Util.onValidateMessage('subjectid', 'subjectmsg');
                returnValue = false;
            }            
            return returnValue;
        },

        goSave(){
            if(this.checkValidate())
            {
                this.subjectObj.type = this.type;      
                this.axios
                    .post('/api/Subject/save', this.subjectObj)
                    .then(response => {            
                        this.getAllSubject();
                        this.subjectObj = {"id":"","name":"","code":"","type":"theory"};
                        this.msg.text = response.data.text;
                        this.msg.type = response.data.type;
                        Util.workAlert('#alertmsg');
                    })
                    .catch(error => {            
                        console.log("err->" + JSON.stringify(this.error.response))
                    });
            }
        },

        goEdit(aId){      
            this.axios
                .get(`/api/Subject/edit/${aId}`)
                .then(response => {                        
                    this.subjectObj = response.data[0];
                    this.type = this.subjectObj.type;                    
                });
        },

        goDelete(aID){
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `Subject/${funName}/${aID}`;
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