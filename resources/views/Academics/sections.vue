<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                Academics
            </h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home</router-link> > Sections
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;" />

        <confirm :url="props"></confirm>
        <Loading></Loading>
        <div class="row rowContainer" style="align-items: end !important;">
            <div class="col-lg-5 col-md-12" style="padding:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Section</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="section">Section Name<strong>*</strong></label>
                                <input id="sectionid" type="text" class="inputbox" v-model="SectionObj.section"
                                    @keyup="onValidate(SectionObj.section, 'sectionid', 'sectionmsg')" 
                                    v-on:blur="onValidate(SectionObj.section, 'sectionid', 'sectionmsg')"/>
                                <span id="sectionmsg" class="error_message">Section Name is required</span>
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
                        <h6>Section List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg" id="delalertmsg"/>
                        <input
                            v-on:keyup="searchTable(searchQuery)"
                            v-model="searchQuery"
                            id="myInput"
                            type="text"
                            placeholder="Search..."
                            class="searchText"
                        />
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Section.xls')" title="Excel">
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
                        <div v-if="SectionList.length == 0">
                            <h1 class="NoData">No Data</h1>
                        </div>
                        <div v-if="SectionList.length != 0" class="table-responsive" id="print">            
                            <table class="table table-hover table-striped" id="studenttable">
                                <thead>
                                    <tr>
                                        <th class="all" nowrap>Section</th>                                        
                                        <th class="all" style="text-align: right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr v-for="section in SectionList" :key="section.id" class="active">
                                        <td class="all" nowrap>{{section.section}}</td>
                                        <td style="text-align: right;">
                                            <i @click="goEdit(section.id)" class="fa fa-pencil pen"></i>
                                            <i @click="goDelete(section.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time"></i>
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
            SectionObj: {},
            SectionList: [],
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
            },      
        };
    },
    created() {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {
            this.deletemsg.text = response.text,
            this.deletemsg.type = response.type
            Util.workAlert('#delalertmsg');
            this.getAllSection();
        });
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.getAllSection();
        });
        this.getAllSection();
    },
    mounted() {
        EventBus.$emit("onLoad");
    },
    methods: {
        getAllSection(){
            EventBus.$emit("onLoad");
            this.axios
                .get('/api/section')
                .then(response => {            
                    this.SectionList = response.data;
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
            if(this.SectionObj.section == "" || this.SectionObj.section == undefined)
            {
                Util.onValidateMessage('sectionid', 'sectionmsg');
                returnValue = false;
            }        
            return returnValue;
        },

        goSave() {
            if(this.checkValidate())
            {
                this.axios
                    .post('/api/Section/save', this.SectionObj)
                    .then(response => {
                        this.SectionObj = {"id":"","section":"","created_at":"","updated_at":""};
                        this.getAllSection();
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
                .get(`/api/Section/edit/${aId}`)
                .then(response => {                        
                    this.SectionObj = response.data;                    
                });
        },

        goDelete(aID){
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `Section/${funName}/${aID}`;            
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