<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Academics</h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home</router-link>> Academic-Year
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <confirm :url="props"></confirm>
        <Loading></Loading>
        <div class="row rowContainer" style="align-items: end !important;margin:0;">
            <div class="col-lg-5 col-md-12" style="padding:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Session</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="session">
                                    Session
                                    <strong>*</strong>
                                </label>
                                <input id="sessionid" type="text" class="inputbox" v-model="AcademicYr.session"
                                    @keyup="onValidate(AcademicYr.session, 'sessionid', 'sessionmsg')" 
                                    v-on:blur="onValidate(AcademicYr.session, 'sessionid', 'sessionmsg')"/>
                                <span id="sessionmsg" class="error_message">Session is required</span>
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
                        <h6>Session List</h6>
                    </div>
                    <div class="card-body">            
                        <message :alertmessage="deletemsg" id="delalertmsg"/>
                        <input v-on:keyup="searchTable(searchQuery)" v-model="searchQuery" id="myInput" type="text" placeholder="Search..." class="searchText"/>
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                    <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Academic_Year.xls')" title="Excel">
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
                        <div v-if="SessionList.length == 0">
                            <h1 class="NoData">No Data</h1>
                        </div>
                        <div v-if="SessionList.length != 0" class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable">
                                <thead>
                                    <tr>
                                        <th class="all" nowrap>Session</th>
                                        <th class="all" nowrap>Status</th>
                                        <th class="all" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr v-for="session in SessionList" :key="session.id" class="active">
                                        <td v-if="session.is_active != 'delete'" class="all" nowrap>{{session.session}}</td>
                                        <td v-if="session.is_active != 'delete'" class="all" nowrap>{{checkSession(session.is_active)}}</td>
                                        <td v-if="session.is_active != 'delete'" style="text-align:right;">
                                            <i @click="goEdit(session.id)" class="fa fa-pencil pen">
                                                <span class="penLabel">Edit</span>
                                            </i>
                                            <i :class="{ 'checkActive': session.is_active === 'yes'}" @click="goDelete(session.id, session.is_active)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
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

<style>
    .checkActive{
        color: #0c0c0c7a;
    }
    .checkActive:hover{
        background: #e7e7e7;
        border-radius: 5px;
        color: #0c0c0c7a;
    }
</style>

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
            AcademicYr: {},
            SessionList: [],
            searchQuery: '',
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
        };
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {            
            this.deletemsg.text = response.text;
            this.deletemsg.type = response.type;
            Util.workAlert('#delalertmsg');
            this.getAllSession();
        });
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.getAllSession();          
        });
        this.getAllSession();
    },
    mounted() {
        EventBus.$emit("onLoad");
    },
    methods: {
        getAllSession() {            
            this.axios.get("/api/academicyr").then(response => {
                this.SessionList = response.data;
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
            if(this.AcademicYr.session == "" || this.AcademicYr.session == undefined)
            {
                Util.onValidateMessage('sessionid', 'sessionmsg');
                returnValue = false;
            }            
            return returnValue;
        },

        goSave() {
            if(this.checkValidate())
            {
                this.axios
                .post("/api/AcademicYear/save", this.AcademicYr)
                .then(response => {
                    this.AcademicYr = { id: "", session: "", is_active: "", created_at: "", updated_at: ""};
                    this.getAllSession();
                    this.msg.text = response.data.text;
                    this.msg.type = response.data.type;
                    Util.workAlert('#alertmsg');
                })
                .catch(error => {
                    console.log("err->" + JSON.stringify(this.error.response));
                });
            }
        },

        goAlertClose(aVal) {
            if (aVal == 1) $("#OthAlert").css("display", "none");
            else $("#deleteAlert").css("display", "none");
        },

        goEdit(aId) {
            this.axios.get(`/api/AcademicYear/edit/${aId}`).then(response => {
                this.AcademicYr = response.data;
            });
        },

        goDelete(aID,aCheckActive) {
            if(aCheckActive != "yes")
            {
                var funName = "delete"; /**Delete function */
                this.props.type = "delete";
                this.props.url = `AcademicYear/${funName}/${aID}`;
            }               
        },

        checkSession(aStatus) {
            if (aStatus == "yes") return "Active";
            else return "";
        },

        searchTable(aValue) {
            Util.searchTable(aValue, '#myTable tr');
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
};
</script>