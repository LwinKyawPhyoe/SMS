<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Transport</h2>
            <h4 class="stuLink">
                <router-link class="home" to="/dashboard">Home</router-link>> Routes
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;"/>
        <Loading></Loading>

        <confirm :url="props"></confirm>
        <div class="row" style="align-items: end !important;margin: 0px">
            <div class="col-lg-5 col-md-12" style="padding: 0px">
                <div class="card">
                    <div class="card-header">
                        <h6>Create Route</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>

                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="route">Route Title<strong>*</strong></label>
                                <input type="text" id="route_title" class="inputbox" v-model="tranRoute.route_title"
                                    @keyup="onValidate(tranRoute.route_title, 'route_title', 'route_title_msg')" 
                                    v-on:blur="onValidate(tranRoute.route_title, 'route_title', 'route_title_msg')" />
                                <span id="route_title_msg" class="error_message">Route title is required</span>
                            </div>
                            <div class="col-12">
                                <label for="fare">Fare</label>
                                <input type="text" class="inputbox" v-model="tranRoute.fare" ref="input"
                                    @keydown="restrictSpecialCharacter($event, 101, tranRoute.fare)"
                                    v-on:blur="formatFare()" @keyup.enter="formatFare()" @click="selectAll()" />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="save"  id="globalSave">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 div_very_small" style="padding: 0px;padding-left: 15px;">
                <div class="card">
                    <div class="card-header">
                        <h6>Route List</h6>
                    </div>
                    <div class="card-body">                        
                        <message :alertmessage="deletemsg" id="delalertmsg"/>

                        <input type="text" placeholder="Search..." class="searchText" />
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                    <a @click.prevent="downloadExcel('studenttable', 'name', 'Tran_Route.xls')" title="Excel">
                                        <i class="fa fa-file-excel-o"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a @click.prevent="printme('print')" title="Print">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                   <a title="Columns" @click="showColumns()">
                                        <i class="fa fa-columns"></i>
                                    </a>
                                    <div id="columns" class="columns">
                                        <div v-for="item in arrayTableColumns">
                                            <p @click="showTableHeader(item)" :id="item.Id" class="tableLink">
                                                <span>{{item.Name}}</span>
                                            </p> 
                                        </div>
                                        <div>
                                            <p @click="clickShowAllColumn(arrayTableColumns)" class="tableLinkActive">
                                                <span>Restore visibility</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div @click="clickBackground()" id="backgroundColumn" class="column_background"></div>
                                </div>
                            </div>
                        </div>
                        <h1 class="NoData" v-if="routeList.length==0">No Data</h1>
                        <div class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable" v-if="routeList.length!=0">
                                <thead>
                                    <tr>
                                        <th :class="arrayTableColumns[0].class" nowrap>Route Title</th>
                                        <th :class="arrayTableColumns[1].class" nowrap>Fare</th>
                                        <th :class="arrayTableColumns[2].class" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="route in routeList" :key="route.id" class="active">
                                        <td :class="arrayTableColumns[0].class" nowrap>{{route.route_title}}</td>
                                        <td :class="arrayTableColumns[1].class" nowrap>{{route.fare}} MMK</td>
                                        <td :class="arrayTableColumns[2].class" style="text-align:right;">
                                            <i @click="goEdit(route.id)" class="fa fa-pencil pen">
                                                <span class="penLabel">Edit</span>
                                            </i>
                                            <i @click="goDelete(route.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
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
import message from "../Alertmessage/message.vue";
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js"
import {Util} from '../../js/util';
import Loading from "../LoadingController.vue";

export default {
    components: {
        confirm,
        message,
        Loading
    },
    data() 
    {
        return {
            arrayTableColumns: [
                {"Name": "Route Title","Id": "Route_Id", "class": "tbl_body_Route"},
                {"Name": "Fare","Id": "Fare_Id", "class": "tbl_body_Fare"},
                {"Name": "Action","Id": "Action_Id", "class": "tbl_body_Action"},
            ],
            tranRoute: {"id":"","route_title":"","fare":""},
            routeList: [],
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

    mounted() {
        EventBus.$emit("onLoad");
    },

    created() 
    {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {            
            this.deletemsg.text = response.text;
            this.deletemsg.type = response.type;
            Util.workAlert('#delalertmsg');
            this.getRouteList();
        });
        this.getRouteList();
    },

    methods: 
    {
        getRouteList()
        {
            EventBus.$emit("onLoad");
            this.routeList = [];
            this.axios.get('/api/tranRouteList').then(response => {    
                this.clickShowAllColumn(this.arrayTableColumns);
                this.routeList = response.data;
                EventBus.$emit("onLoadEnd");
            });
        },

        goSave() 
        {
            if(this.checkValidate())
            {
                this.axios.post('/api/TranRoute/save', this.tranRoute).then(response => {              
                    if(response.data.type == "success"){
                        this.tranRoute = {"id":"","route_title":"","fare":""},
                        this.getRouteList();
                    }
                    this.msg.text = response.data.text;
                    this.msg.type = response.data.type;
                    Util.workAlert('#alertmsg');
                })
                .catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response))
                });
            }
        },

        goEdit(aId)
        {      
            this.axios.get(`/api/TranRoute/edit/${aId}`).then(response => {
                this.tranRoute = response.data;
            });
        },

        goDelete(aID)
        {
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `TranRoute/${funName}/${aID}`;
        },

        onValidate(value, inputId, megId)
        {
            Util.onValidate(value, inputId, megId);
        },

        checkValidate()
        {
            if(this.tranRoute.route_title == "" || this.tranRoute.route_title == undefined)
            {
                Util.onValidateMessage('route_title', 'route_title_msg');
            }
            else
            {
                return true;
            }

            return false;
        },

        restrictSpecialCharacter(event, fid, value)
        {
            Util.restrictSpecialCharacter(event, fid, value);
        },

        formatFare()
        {
            let amount = this.tranRoute.fare.replace(/,/g, '');
            if(amount == "" || parseFloat(amount) == 0){
                this.tranRoute.fare = "0.00";
            }else{
                this.tranRoute.fare = this.thousand_sperator(parseFloat(amount).toFixed(2));
            }
        },

        thousand_sperator(num) 
        {
            return Util.thousand_sperator(num);
        },

        selectAll() {
            this.$refs.input.select();
        },
        printme(table)
        {
            Util.printme(table);
        },
        downloadExcel(table, name, filename) 
        {
            Util.downloadExcel(table,name,filename);
        },
        // Column Hide 
        showColumns(){
            Util.showColumns('columns','backgroundColumn');
        },
        clickBackground(){
            Util.clickBackground('columns','backgroundColumn');
        },
        showTableHeader(data){
            Util.showTableHeader(data);
        },
        clickShowAllColumn(data){
            Util.clickShowAllColumn(data);
        },

    }
};
</script>
