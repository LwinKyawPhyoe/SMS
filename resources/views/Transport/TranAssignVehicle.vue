<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Transport</h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home</router-link>> Assign Vehicle
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;"/>
        <Loading></Loading>
        <confirm :url="props"></confirm>
        <div class="row" style="align-items: end !important;margin: 0px">
            <div class="col-lg-5 col-md-12" style="padding:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Assign Vehicle On Route</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="class">Route<strong>*</strong></label>
                                <select id="routeid" @change="changeRoute(vehicalRoute.routeid)" class="inputbox" v-model="vehicalRoute.routeid">
                                    <option v-for="route in routeList" :key="route.id" :value="route.id">{{route.route_title}}</option>
                                </select>
                                <span id="routemsg" class="error_message">Route is required</span>
                            </div>
                            <div class="col-12">
                                <label for="class">Vehicle<strong>*</strong></label>
                                <div v-for="Obj in vehicleList" :key="Obj.id" class="checkbox">
                                    <label class="checkboxlabel">
                                        <input type="checkbox" class="checkboxinput" value="" v-model="Obj.checked" @click="click_checkbox($event,Obj)" />{{ Obj.vehicle_no }}                                    
                                    </label>
                                </div>
                                <span id="vehiclemsg" class="error_message">Vehicle is required</span>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="save" id="globalSave">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 div_very_small" style="padding:0;padding-left: 15px;">
                <div class="card">
                    <div class="card-header">
                        <h6>Class List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg" id="delalertmsg"/>
                        <input type="text" placeholder="Search..." class="searchText" />
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                    <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Tran_Assign_Vehicle.xls')" title="Excel">
                                        <i class="fa fa-file-excel-o"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="#" @click.prevent="printme('print')" title="Print">
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
                        <h1 class="NoData" v-if="AssVehicleList.length==0">No Data</h1>
                        <div class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable" v-if="AssVehicleList.length!=0">
                                <thead>
                                    <tr>
                                        <th :class="arrayTableColumns[0].class" nowrap>Route</th>
                                        <th :class="arrayTableColumns[1].class" nowrap>Vehicle</th>
                                        <th :class="arrayTableColumns[2].class" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="obj in AssVehicleList" :key="obj.id" class="active">
                                        <td :class="arrayTableColumns[0].class" nowrap style="vertical-align:top;">{{getRouteTitle(obj.route_id)}}</td>
                                        <td :class="arrayTableColumns[1].class" nowrap style="vertical-align:top;">
                                            <label v-for="vehicleno in obj.vehicle_id" :key="vehicleno" style="display: block; margin: 0px;font-size: 13px;font-weight: 200;">{{getVehicleNo(vehicleno)}}</label>                                            
                                        </td>
                                        <td :class="arrayTableColumns[2].class" style="text-align:right; vertical-align:top;">
                                            <i @click="goEdit(obj)" class="fa fa-pencil pen">
                                                <span class="penLabel">Edit</span>
                                            </i>
                                            <i @click="goDelete(obj.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
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
                {"Name": "Route","Id": "Route_Title_Id", "class": "tbl_body_Route"},
                {"Name": "Vehicle","Id": "Vehicle_Num_Id", "class": "tbl_body_Vehicle"},
                {"Name": "Action","Id": "Action_Id", "class": "tbl_body_Action"},
            ],
            vehicalRoute: {"id": "","routeid": "", "vehicleno": ""},
            Vehicle: [],
            routeList: [{'id':0,'route_title':'Select Route'}],
            vehicleList: [],
            AssVehicleList: [],
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
            this.routeList = [{'id':0,'route_title':'Select Route'}];
            this.getRouteList();
            this.getVehicleList();
            this.getAssVehicleList();
        });
        EventBus.$on("SessionSaved", response => {            
            console.log(JSON.stringify(response));
            this.getRouteList();
            this.getVehicleList();
            this.getAssVehicleList();
        });

        this.getRouteList();
        this.getVehicleList();
        this.getAssVehicleList();
    },
    methods: 
    {
        getAssVehicleList(){
            EventBus.$emit("onLoad");
            this.AssVehicleList = [];
            this.axios.get('/api/vehicleroute').then(response => {  
                this.clickShowAllColumn(this.arrayTableColumns);                                                                                          
                for(let i=0; i < response.data.length; i++){
                    var vehiclenoID = [];
                    vehiclenoID = response.data[i].vehicle_id.split(',');
                    this.AssVehicleList.push({"id": response.data[i].id, "route_id": response.data[i].route_id, "vehicle_id": vehiclenoID});
                }
                EventBus.$emit("onLoadEnd");           
            });
        },

        getRouteTitle(aRouteId){
            for(let i=0; i<this.routeList.length; i++){
                if(aRouteId == this.routeList[i].id){
                    return this.routeList[i].route_title;
                    break;
                }
            }
        },

        getVehicleNo(aVehicleId){
            for(let i=0; i< this.vehicleList.length; i++){
                if(aVehicleId == this.vehicleList[i].id){
                    return this.vehicleList[i].vehicle_no;
                    break;
                }
            }
        },

        getVehicleList()
        {
            this.vehicleList = [];
            this.axios.get('/api/tranVehicleList').then(response => {                                                    
                for(let i=0; i < response.data.length; i++){
                    this.vehicleList.push({"id": response.data[i].id,"vehicle_no": response.data[i].vehicle_no, "checked": false});
                }                
            });
        },

        getRouteList()
        {
            this.routeList = [{'id':0,'route_title':'Select Route'}];
            let list = [];
            this.axios.get('/api/tranRouteList').then(response => {            
                list  = response.data;
                for(let i = 0; i < list.length; i++)
                {
                    this.routeList.push({id:list[i].id, route_title:list[i].route_title})
                }
                this.vehicalRoute.routeid = this.routeList[0].id;
            });
        },

        click_checkbox(e, aObj){
            if(e.target.checked)
            {
                this.Vehicle.push(aObj.id);
                $('#vehiclemsg').css('display', 'none');                    
            }
            else
            {
                this.Vehicle.splice(this.Vehicle.map(item => item.id).indexOf(aObj.id), 1);
                if(this.Vehicle == []|| this.Vehicle.length == 0 || this.Vehicle == undefined)
                {
                    $('#vehiclemsg').css('display', 'block')
                }
            }
        },

        changeRoute(aID){            
            if(aID == 0)
            {
                $('#routeid').css('border', '1px solid red');
            }
            else
            {
                $('#routemsg').css('display', 'none');
                $('#routeid').css('border', '1px solid #d2d6de');
            }
        },

        checkValidate()
        {
            if(this.vehicalRoute.routeid == "" || this.vehicalRoute.routeid == undefined || this.vehicalRoute.routeid == 0)
            {
                $('#routemsg').css('display', 'block');
                $('#routeid').css('border', '1px solid red');
                return false;
            }           
            if(this.Vehicle == []|| this.Vehicle.length == 0 || this.Vehicle == undefined)
            {
                $('#vehiclemsg').css('display', 'block');
                return false;
            }
            else
            {
                return true;
            }
            return false;
        },

        goSave() 
        {
            if(this.checkValidate())
            {
                this.vehicalRoute.vehicleno = this.Vehicle.toString();                
                this.axios
                    .post('/api/VehicleRoute/save', this.vehicalRoute)
                    .then(response => {
                        this.getAssVehicleList();
                        this.vehicalRoute = {"id": "","routeid": 0, "vehicleno": ""};
                        this.Vehicle = [];
                        this.msg.text = response.data.text;
                        this.msg.type = response.data.type;
                        Util.workAlert('#alertmsg');
                    })
                    .catch(error => {            
                        console.log("err->" + JSON.stringify(this.error.response))
                    });
            }
        },

        goEdit(aObj)
        {
            this.vehicalRoute.id = aObj.id;
            this.vehicalRoute.routeid = aObj.route_id;
            
            for(let a=0; a < aObj.vehicle_id.length; a++){
                for(let i=0; i < this.vehicleList.length; i++){                        
                    if(this.vehicleList[i].id == Number(aObj.vehicle_id[a])){
                        this.Vehicle.push(Number(aObj.vehicle_id[a]));
                        this.vehicleList.splice(i, 1, {"id": this.vehicleList[i].id, "vehicle_no": this.vehicleList[i].vehicle_no, "checked": true});
                    }
                }
            }
        },

        goDelete(aID)
        {
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `VehicleRoute/${funName}/${aID}`;
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